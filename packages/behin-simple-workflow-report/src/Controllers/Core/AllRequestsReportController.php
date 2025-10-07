<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use Behin\Ami\Services\CallHistoryService;
use Behin\SimpleWorkflow\Models\Core\Inbox;
use Behin\SimpleWorkflowReport\Exports\AllRequestsReportExport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Behin\SimpleWorkflow\Models\Core\ViewModel;

class AllRequestsReportController extends Controller
{
    protected array $openStatuses = ['new', 'opened', 'inProgress', 'draft'];

    public function index(Request $request)
    {
        $filters = $request->except('page');
        $perPage = (int) ($filters['per_page'] ?? 15);
        $filters = Arr::where($filters, fn($value, $key) => $value !== null && $value !== '');
        $query = $this->baseQuery();
        $query = $this->applyFilters($query, $filters);
        $rows = $query->paginate($perPage);
        $rows->appends($filters);
        $rows->getCollection()->transform(function ($row) {
            $row->last_status = Inbox::where('case_id', $row->id)
                ->whereNotIn('status', ['done', 'doneByOther', 'canceled'])
                ->get();
            $row->city = collect([$row->province_name ?? null, $row->city_name ?? null])
                ->filter()
                ->implode(' - ') ?: null;
            return $row;
        });

        // return $rows;
        return view('SimpleWorkflowReportView::Core.AllRequests.index', [
            'rows' => $rows,
            'filters' => $filters,
            'perPage' => $perPage,
        ]);
    }

    protected function baseQuery(): Builder
    {
        $caseDataQuery = DB::table('wf_cases as c')
            ->leftJoin('wf_variables as v', 'c.id', '=', 'v.case_id')
            ->select(
                'c.id',
                'c.number',
                DB::raw("MAX(CASE WHEN v.key IN ('fullname') THEN v.value END) as fullname"),
                DB::raw("MAX(CASE WHEN v.key = 'national_id' THEN v.value END) as national_id"),
                DB::raw("MAX(CASE WHEN v.key = 'mobile' THEN v.value END) as mobile"),
                DB::raw("MAX(CASE WHEN `key` IN ('tel') THEN value END) as tel"),
                DB::raw("MAX(CASE WHEN `key` IN ('guild_number') THEN value END) as guild_number"),
                DB::raw("MAX(CASE WHEN `key` IN ('guild_name') THEN value END) as guild_name"),
                DB::raw("MAX(CASE WHEN `key` = 'catagory' THEN value END) as catagory"),
                DB::raw("MAX(CASE WHEN `key` IN ('city') THEN value END) as city_id"),
                DB::raw("MAX(CASE WHEN `key` IN ('customer_info_is_aproved') THEN value END) as customer_info_is_aproved"),
            )
            ->groupBy('c.id', 'c.number');

        return DB::query()
            ->fromSub($caseDataQuery, 'case_data')
            ->leftJoin('cities as city_lookup', 'case_data.city_id', '=', 'city_lookup.id')
            ->select(
                'case_data.*',
                DB::raw('city_lookup.city as city_name'),
                DB::raw('city_lookup.province as province_name')
            );
    }

    protected function applyFilters($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value === null || $value === '') {
                unset($filters[$key]);
            }
        }

        if (!empty($filters['case_number'])) {
            $query->where('number', 'like', '%' . $filters['case_number'] . '%');
        }

        if (!empty($filters['fullname'])) {
            $query->where('fullname', 'like', '%' . $filters['fullname'] . '%');
        }

        if (!empty($filters['mobile'])) {
            $query->where('mobile', 'like', '%' . $filters['mobile'] . '%');
        }

        if (!empty($filters['tel'])) {
            $query->where('tel', 'like', '%' . $filters['tel'] . '%');
        }

        if (!empty($filters['guild_number'])) {
            $query->where('guild_number', 'like', '%' . $filters['guild_number'] . '%');
        }

        if (!empty($filters['guild_name'])) {
            $query->where('guild_name', 'like', '%' . $filters['guild_name'] . '%');
        }

        if (!empty($filters['catagory'])) {
            $query->where('catagory', 'like', '%' . $filters['catagory'] . '%');
        }

        if (!empty($filters['city'])) {
            $query->where(function ($cityQuery) use ($filters) {
                $cityQuery->where('city_name', 'like', '%' . $filters['city'] . '%')
                    ->orWhere('province_name', 'like', '%' . $filters['city'] . '%')
                    ->orWhere('city_id', 'like', '%' . $filters['city'] . '%');
            });
        }

        if (!empty($filters['customer_info_is_aproved'])) {
            $query->where('customer_info_is_aproved', 'like', '%' . $filters['customer_info_is_aproved'] . '%');
        }

        if (!empty($filters['last_status'])) {
            $query->whereExists(function ($subQuery) use ($filters) {
                $subQuery->select(DB::raw(1))
                    ->from('wf_inbox as wi')
                    ->join('wf_task as wt', 'wt.id', '=', 'wi.task_id')
                    ->whereColumn('wi.case_id', 'case_data.id')
                    ->whereNotIn('wi.status', ['done', 'doneByOther', 'canceled'])
                    ->where('wt.name', 'like', '%' . $filters['last_status'] . '%');
            });
        }


        return $query;
    }

    public function export(Request $request): BinaryFileResponse
    {
        $filters = $request->except('page');
        $perPage = (int) ($filters['per_page'] ?? 15);
        $filters = Arr::where($filters, fn($value, $key) => $value !== null && $value !== '');
        $query = $this->baseQuery();
        $query = $this->applyFilters($query, $filters);

        $rows = $query->get();
        $rows->each(function ($row) {
            $statuses = Inbox::where('case_id', $row->id)
                ->whereNotIn('status', ['done', 'doneByOther', 'canceled'])
                ->with('task') // 👈 برای بارگذاری رابطه task
                ->get()
                ->map(fn($inbox) => $inbox->task?->name) // 👈 استخراج نام تسک
                ->filter() // حذف nullها
                ->toArray();

            $row->last_status = implode(', ', $statuses);
            $row->city = collect([$row->province_name ?? null, $row->city_name ?? null])
                ->filter()
                ->implode(' - ') ?: null;
            return $row;
        });
        // حالا خروجی اکسل ساده
        $filename = 'requests_export_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new AllRequestsReportExport($rows), $filename);
    }

    public function show(string $caseNumber): View
    {
        $row = $this->baseQuery()
            ->where('number', $caseNumber)
            ->first();

        if (!$row) {
            abort(404);
        }

        $row->city = collect([$row->province_name ?? null, $row->city_name ?? null])
            ->filter()
            ->implode(' - ') ?: null;

        // $row = $this->prepareRows(collect([$row]))->first();

        /** @var CallHistoryService $callHistoryService */
        $callHistoryService = app(CallHistoryService::class);

        $callRecords = collect();
        $callRecordsError = null;
        $searchedNumbers = [];

        if (!empty($row->mobile)) {
            $callRecords = $callHistoryService->getCallsByPhone($row->mobile);
            $callRecordsError = $callHistoryService->getLastError();
            $searchedNumbers = $callHistoryService->getLastSearchNumbers();
        }

        return view('SimpleWorkflowReportView::Core.AllRequests.show', [
            'requestRow' => $row,
            'conversationViewModel' => ViewModel::find('912880ce-7acf-4735-9170-cbc34b39362b'),
            'callRecords' => $callRecords,
            'callRecordsError' => $callRecordsError,
            'callRecordsSearchedNumbers' => $searchedNumbers,
        ]);
    }
}
