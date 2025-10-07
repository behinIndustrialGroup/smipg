<?php

use Behin\SimpleWorkflow\Controllers\Core\ConditionController;
use Behin\SimpleWorkflow\Controllers\Core\FieldController;
use Behin\SimpleWorkflow\Controllers\Core\FormController;
use Behin\SimpleWorkflow\Controllers\Core\InboxController;
use Behin\SimpleWorkflow\Controllers\Core\RoutingController;
use Behin\SimpleWorkflow\Controllers\Core\ScriptController;
use Behin\SimpleWorkflow\Controllers\Core\TaskActorController;
use Behin\SimpleWorkflow\Controllers\Core\TaskController;
use Behin\SimpleWorkflow\Models\Core\Cases;
use Behin\SimpleWorkflow\Models\Core\Variable;
use Behin\SimpleWorkflowReport\Controllers\Core\AllRequestsReportController;
use Behin\SimpleWorkflowReport\Controllers\Core\ExpiredController;
use Behin\SimpleWorkflowReport\Controllers\Core\FinReportController;
use Behin\SimpleWorkflowReport\Controllers\Core\ProcessController;
use Behin\SimpleWorkflowReport\Controllers\Core\ReportController;
use Behin\SimpleWorkflowReport\Controllers\Core\RoleReportFormController;
use Behin\SimpleWorkflowReport\Controllers\Core\SummaryReportController;
use Behin\SimpleWorkflowReport\Controllers\Core\TimeoffController;
use Behin\SimpleWorkflowReport\Controllers\Scripts\TotalTimeoff;
use Behin\SimpleWorkflowReport\Controllers\Scripts\UserTimeoffs;
use BehinProcessMaker\Models\PMVariable;
use BehinProcessMaker\Models\PmVars;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Mkhodroo\UserRoles\Middlewares\Access;

Route::name('simpleWorkflowReport.')->prefix('workflow-report')->middleware(['web', 'auth'])->group(function () {
    Route::get('index', [ReportController::class, 'index'])->name('index');
    Route::resource('summary-report', SummaryReportController::class);
    Route::get('all-requests/export', [AllRequestsReportController::class, 'export'])->middleware(Access::class. ':گزارش کل درخواست های ثبت شده')->name('all-requests.export');
    Route::get('all-requests/{case_number}', [AllRequestsReportController::class, 'show'])->middleware(Access::class. ':گزارش کل درخواست های ثبت شده')->name('all-requests.show');
    Route::get('all-requests', [AllRequestsReportController::class, 'index'])->middleware(Access::class. ':گزارش کل درخواست های ثبت شده')->name('all-requests.index');

    Route::name('process.')->prefix('process')->group(function(){
        Route::prefix('{processId}')->group(function(){
            Route::post('update', [ProcessController::class, 'update'])->name('update');
            Route::get('export', [ProcessController::class, 'export'])->name('export');
        });
    });
});
