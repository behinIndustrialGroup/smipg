<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\AgencyInfo\Controllers\AgencyController;
use Mkhodroo\AgencyInfo\Controllers\AgencyListController;
use Mkhodroo\AgencyInfo\Controllers\CreateAgencyController;
use Mkhodroo\UserRoles\Controllers\GetRoleController;
use Rap2hpoutre\FastExcel\FastExcel;

Route::name('agencyInfo.')->prefix('agency-info')->middleware(['web', 'auth','access'])->group(function(){
    Route::get('test', function(){
        echo "<pre>";
        $collection = (new FastExcel)->import(public_path('test.xlsx'), function($line){
            print_r($line);
        });
        echo "</pre>";
    });
    Route::get('create-form', [CreateAgencyController::class, 'view'])->name('createForm');
    Route::post('create', [CreateAgencyController::class, 'create'])->name('create');
    Route::get('list-form', [AgencyListController::class, 'view'])->name('listForm');
    Route::get('list', [AgencyListController::class, 'list'])->name('list');
    Route::get('edit/{parent_id}', [AgencyController::class, 'view'])->name('editForm');
   Route::post('fin-edit', [AgencyController::class, 'finEdit'])->name('finEdit');

});