<?php

use ExcelReader\Controllers\ExcelController;
use ExcelReader\Controllers\FinExcelController;
use ExcelReader\Controllers\MarketingExcelController;
use Illuminate\Support\Facades\Route;

Route::name('excelReader.')->prefix('excel')->middleware('web', 'auth')->group(function () {
    Route::get('input', [ExcelController::class, 'input'])->name('input');
    Route::post('excel-reader', [ExcelController::class, 'read'])->name('read');
});

Route::name('finExcelReader.')->prefix('fin-excel')->middleware('web', 'auth')->group(function () {
    Route::get('', [FinExcelController::class, 'index'])->name('index');
    Route::post('excel-reader', [FinExcelController::class, 'read'])->name('read');
    Route::get('return-idnex', [FinExcelController::class, 'returnIndex'])->name('returnIndex');
});

Route::name('marketingCardExcelReader.')->prefix('marketing-excel')->middleware('web', 'auth')->group(function () {
    Route::get('', [MarketingExcelController::class, 'index'])->name('index');
    Route::post('excel-reader', [MarketingExcelController::class, 'read'])->name('read');
    Route::get('return-idnex', [MarketingExcelController::class, 'returnIndex'])->name('returnIndex');
});
