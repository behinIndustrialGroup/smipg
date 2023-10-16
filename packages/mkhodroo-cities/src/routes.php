<?php

use Illuminate\Support\Facades\Route;

Route::name('city.')->prefix('city')->middleware(['web', 'auth','access'])->group(function(){
    
});