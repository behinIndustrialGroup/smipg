<?php

namespace Behin\SimpleWorkflowReport\Controllers\Core;

use App\Http\Controllers\Controller;
use Behin\Ami\Services\CallHistoryService;
use Behin\SimpleWorkflow\Models\Core\Cases;
use Behin\SimpleWorkflow\Models\Core\Inbox;
use Behin\SimpleWorkflowReport\Exports\AllRequestsReportExport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
            return $row;
        });

        // return $rows;
        return view('SimpleWorkflowReportView::Core.AllRequests.index', [
            'rows' => $rows,
            'filters' => $filters,
            'perPage' => $perPage,
        ]);
    }

    protected function baseQuery()
    {
        return DB::table('wf_cases as c')
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
                DB::raw("MAX(CASE WHEN `key` IN ('city') THEN value END) as city"),
                DB::raw("MAX(CASE WHEN `key` IN ('customer_info_is_aproved') THEN value END) as customer_info_is_aproved"),
            )
            ->groupBy('c.id', 'c.number');
    }

    protected function applyFilters($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value === null || $value === '') {
                unset($filters[$key]);
            }
        }

        if (!empty($filters['case_number'])) {
            $query->having('number', 'like', '%' . $filters['case_number'] . '%');
        }

        if (!empty($filters['fullname'])) {
            $query->having('fullname', 'like', '%' . $filters['fullname'] . '%');
        }

        if (!empty($filters['mobile'])) {
            $query->having('mobile', 'like', '%' . $filters['mobile'] . '%');
        }

        if (!empty($filters['tel'])) {
            $query->having('tel', 'like', '%' . $filters['tel'] . '%');
        }

        if (!empty($filters['guild_number'])) {
            $query->having('guild_number', 'like', '%' . $filters['guild_number'] . '%');
        }

        if (!empty($filters['guild_name'])) {
            $query->having('guild_name', 'like', '%' . $filters['guild_name'] . '%');
        }

        if (!empty($filters['catagory'])) {
            $query->having('catagory', 'like', '%' . $filters['catagory'] . '%');
        }

        if (!empty($filters['city'])) {
            $query->having('city', 'like', '%' . $filters['city'] . '%');
        }

        if (!empty($filters['customer_info_is_aaproved'])) {
            $query->having('customer_info_is_aaproved', 'like', '%' . $filters['customer_info_is_aaproved'] . '%');
        }

        if (!empty($filters['last_status'])) {
            $query->whereExists(function ($subQuery) use ($filters) {
                $subQuery->select(DB::raw(1))
                    ->from('wf_inbox as wi')
                    ->join('wf_task as wt', 'wt.id', '=', 'wi.task_id')
                    ->whereColumn('wi.case_id', 'c.id')
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
            return $row;
        });
        // حالا خروجی اکسل ساده
        $filename = 'requests_export_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new AllRequestsReportExport($rows), $filename);
    }

    public function show(string $caseNumber): View
    {
        $row = $this->baseQuery()
            ->where('c.number', $caseNumber)
            ->first();

        if (!$row) {
            abort(404);
        }

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
