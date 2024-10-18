<?php

namespace Behin\AgencyInfoReport\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mkhodroo\Cities\Controllers\ProvinceController;

class AgencyReportByProvinceController extends Controller
{
    public static function byStatus()
    {
        $subQuery = DB::table('agency_info')
            ->select(
                'parent_id',
                DB::raw("MAX(CASE WHEN `key` = 'new_status' THEN value END) as new_status"),
                DB::raw("MAX(CASE WHEN `key` = 'province' THEN value END) as province")
            )
            ->groupBy('parent_id');

        $searchQuery = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
            ->select(
                'province',
                DB::raw('COUNT(*) as total_centers'),
                DB::raw("SUM(CASE WHEN new_status = 'صادر شده' THEN 1 ELSE 0 END) as issued"),
                DB::raw("SUM(CASE WHEN new_status = 'درحال بررسی' THEN 1 ELSE 0 END) as under_review"),
                DB::raw("SUM(CASE WHEN new_status = 'منقضی شده' THEN 1 ELSE 0 END) as expired"),
                DB::raw("SUM(CASE WHEN new_status = 'جدید' THEN 1 ELSE 0 END) as new"),
                DB::raw("SUM(CASE WHEN new_status = 'فاقد پروانه' THEN 1 ELSE 0 END) as without_license"),
                DB::raw("SUM(CASE WHEN new_status = 'در حال تکمیل' THEN 1 ELSE 0 END) as in_progress")
            )
            ->groupBy('province')
            ->get()->each(function($row){
                $row->province_name = ProvinceController::getById($row->province)?->name;
            });
        return view('AgencyReportView::by-province-by-status')->with([
            'data' => $searchQuery
        ]);
    }
}
