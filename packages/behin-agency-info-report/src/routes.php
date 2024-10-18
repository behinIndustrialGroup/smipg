<?php

use App\Models\FinInfo;
use App\Models\HidroModel;
use App\Models\KamFesharModel;
use App\Models\MarakezModel;
use Behin\AgencyInfoReport\Controllers\AgencyReportByProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mkhodroo\AgencyInfo\Controllers\AgencyController;
use Mkhodroo\AgencyInfo\Controllers\AgencyDocsController;
use Mkhodroo\AgencyInfo\Controllers\AgencyListController;
use Mkhodroo\AgencyInfo\Controllers\CreateAgencyController;
use Mkhodroo\AgencyInfo\Controllers\DebtController;
use Mkhodroo\AgencyInfo\Controllers\LastActionController;
use Mkhodroo\AgencyInfo\Controllers\QueryController;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\UserRoles\Controllers\GetRoleController;
use Rap2hpoutre\FastExcel\FastExcel;

Route::name('agencyInfoReport.')->prefix('agency-info-report')->middleware(['web', 'auth'])->group(function () {
    Route::name('byProvince.')->prefix('by-province')->group(function(){
        Route::get('by-status', [AgencyReportByProvinceController::class, 'byStatus'])->name('byStatus');
    });
});
