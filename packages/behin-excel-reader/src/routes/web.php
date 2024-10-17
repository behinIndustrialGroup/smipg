<?php

use ExcelReader\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

Route::name('excelReader.')->prefix('excel')->middleware('web')->group(function(){
    Route::get('input', [ExcelController::class, 'input'])->name('input');
    Route::post('excel-reader', [ExcelController::class, 'read'])->name('read');
    });
