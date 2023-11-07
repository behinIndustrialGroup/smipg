<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\UserRoles\Controllers\GetRoleController;

Route::name('atmn.')->prefix('atmn')->middleware(['web', 'auth','access'])->group(function(){
    
});