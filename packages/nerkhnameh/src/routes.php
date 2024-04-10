<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\DateConvertor\Controllers\SDate;
use Mkhodroo\Nerkhnameh\Controllers\RegisterController;
use Mkhodroo\Voip\Controllers\VoipController;

Route::name('nerkhnameh.')->prefix('nerkhnameh')->group(function(){
    Route::get('', [RegisterController::class, 'registerForm'])->name('auto');
});