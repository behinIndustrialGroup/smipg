<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mkhodroo\AgencyInfo\Controllers\AgencyController;
use Mkhodroo\AgencyInfo\Controllers\AgencyDocsController;
use Mkhodroo\AgencyInfo\Controllers\AgencyListController;
use Mkhodroo\AgencyInfo\Controllers\CreateAgencyController;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\UserRoles\Controllers\GetRoleController;
use Rap2hpoutre\FastExcel\FastExcel;

Route::name('agencyInfo.')->prefix('agency-info')->middleware(['web', 'auth', 'access'])->group(function () {
    Route::get('test', function () {
        echo "<pre>";

        $collection = (new FastExcel)->import(public_path('test.xlsx'));
        $n=1;
        foreach ($collection as $line) {
            if($n > 300){
                return 'grether than';
            }
            $cat = trim($line['رسته صنفی']);
            if ($cat === "__" || $cat === "") {
                $line['رسته صنفی'] = 'unknown';
                $line['دسته بندی'] = 'unknown';
            } elseif ($cat === "ایمنی-شارژ") {
                $line['رسته صنفی'] = 'charging-fire-cylenders';
                $line['دسته بندی'] = 'safety';
            } elseif ($cat === "صنعتی-خرده") {
                $line['رسته صنفی'] = 'retail';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "صنعتی") {
                $line['رسته صنفی'] = 'unknown';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "صنعتی-شارژ") {
                $line['رسته صنفی'] = 'sale-and-charging-insdustrial-gas';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "ایمنی-فروش") {
                $line['رسته صنفی'] = 'saling-fire-cylenders';
                $line['دسته بندی'] = 'safety';
            } elseif ($cat === "ایمنی") {
                $line['رسته صنفی'] = 'unknown';
                $line['دسته بندی'] = 'safety';
            } elseif ($cat === "صنعتی-عمده") {
                $line['رسته صنفی'] = 'wholesaling-industrial-gas';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "تولید کننده") {
                $line['رسته صنفی'] = 'producer';
                $line['دسته بندی'] = 'unknown';
            } elseif ($cat === "صنعتی-تولید") {
                $line['رسته صنفی'] = 'producer';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "صنعتی -خرده") {
                $line['رسته صنفی'] = 'retail';
                $line['دسته بندی'] = 'industrial';
            } elseif ($cat === "ایمنی-خرده") {
                $line['رسته صنفی'] = 'saling-fire-cylenders';
                $line['دسته بندی'] = 'safety';
            } elseif ($cat === "ایمنی-شارز") {
                $line['رسته صنفی'] = 'charging-fire-cylenders';
                $line['دسته بندی'] = 'safety';
            } elseif ($cat === "تولید-غیر مجاز") {
                $line['رسته صنفی'] = 'producer';
                $line['دسته بندی'] = 'unknown';
            }
            $line['province'] = CityController::getCityByName($line['استان'], $line['شهر/شهرستان'])?->id;
            if (!$line['province']) {
                CityController::create($line['استان'], $line['شهر/شهرستان']);
                $line['province'] = CityController::getCityByName($line['استان'], $line['شهر/شهرستان'])?->id;
            }
            $r = new Request([
                'guild_catagory' => $line['رسته صنفی']
            ]);

            $agency_id = CreateAgencyController::create($r)?->id;
            AgencyController::create($agency_id, 'file_number', $line['شماره پرونده']);
            AgencyController::create($agency_id, 'catagory', $line['دسته بندی']);
            AgencyController::create($agency_id, 'firstname', $line['نام']);
            AgencyController::create($agency_id, 'lastname', $line['نام خانوادگی']);
            AgencyController::create($agency_id, 'national_id', $line['کد ملی']);
            AgencyController::create($agency_id, 'mobile', $line['تلفن']);
            AgencyController::create($agency_id, 'phone', '');
            AgencyController::create($agency_id, 'guild_number', $line['شناسه صنفی']);
            AgencyController::create($agency_id, 'issued_date', $line['تاریخ صدور']);
            AgencyController::create($agency_id, 'province', $line['province']);
            AgencyController::create($agency_id, 'status', $line['وضعیت']);
            AgencyController::create($agency_id, 'request_type', $line['نوع درخواست']);
            AgencyController::create($agency_id, 'warning', $line['اخطاریه/ اماکن ']);
            AgencyController::create($agency_id, 'description', $line['توضیحات']);
            AgencyController::create($agency_id, 'membership96', $line['سال 96 ']);
            AgencyController::create($agency_id, 'membership97', $line['سال 97']);
            AgencyController::create($agency_id, 'membership98', $line['سال 98']);
            AgencyController::create($agency_id, 'membership99', $line['سال 99']);
            AgencyController::create($agency_id, 'membership00', $line['سال  1400']);
            AgencyController::create($agency_id, 'membership01', $line['سال 1401']);
            AgencyController::create($agency_id, 'membership02', $line['سال1402']);
        }
        echo "</pre>";
    });
    Route::get('create-form', [CreateAgencyController::class, 'view'])->name('createForm');
    Route::post('create', [CreateAgencyController::class, 'create'])->name('create');
    Route::get('list-form', [AgencyListController::class, 'view'])->name('listForm');
    Route::get('list', [AgencyListController::class, 'list'])->name('list');
    Route::post('filter-list', [AgencyListController::class, 'filterList'])->name('filterList');
    Route::get('edit/{parent_id}', [AgencyController::class, 'view'])->name('editForm');
    Route::post('edit', [AgencyController::class, 'edit'])->name('edit');
    Route::post('fin-edit', [AgencyController::class, 'finEdit'])->name('finEdit');
    Route::post('docs-edit', [AgencyDocsController::class, 'docsEdit'])->name('docsEdit');
    Route::post('delete-info', [AgencyController::class, 'deleteByKey'])->name('deleteByKey');
});
