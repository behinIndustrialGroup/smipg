<?php

use Illuminate\Support\Facades\Route;
use Modules\MarketingCard\App\Http\Controllers\MarketingCardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::resource('marketingcard', MarketingCardController::class)->names('marketingcard');
    Route::get('/download-qrcode/{marketingcard}', [MarketingCardController::class, 'downloadQRCode'])->name('marketingcard.downloadQr');
});
