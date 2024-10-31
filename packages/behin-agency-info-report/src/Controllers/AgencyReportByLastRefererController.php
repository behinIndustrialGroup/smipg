<?php

namespace Behin\AgencyInfoReport\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mkhodroo\Cities\Controllers\ProvinceController;

class AgencyReportByLastRefererController extends Controller
{
    public static function byStatus()
    {
        $subQuery = DB::table('agency_info')
            ->select(
                'parent_id',
                DB::raw("MAX(CASE WHEN `key` = 'new_status' THEN value END) as new_status"),
                DB::raw("MAX(CASE WHEN `key` = 'last_referral' THEN value END) as last_referral")
            )
            ->groupBy('parent_id');

        $searchQuery = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
            ->select(
                'last_referral',
                DB::raw('COUNT(*) as total_centers'),
                DB::raw("SUM(CASE WHEN new_status = 'صادر شده' THEN 1 ELSE 0 END) as issued"),
                DB::raw("SUM(CASE WHEN new_status = 'درحال بررسی' THEN 1 ELSE 0 END) as under_review"),
                DB::raw("SUM(CASE WHEN new_status = 'فاقد پروانه / منقضی شده' THEN 1 ELSE 0 END) as expired"),
                DB::raw("SUM(CASE WHEN new_status = 'جدید' THEN 1 ELSE 0 END) as new"),
            )
            ->groupBy('last_referral')
            ->get();
        return view('AgencyReportView::by-last-referer-by-status')->with([
            'data' => $searchQuery
        ]);
    }
}
