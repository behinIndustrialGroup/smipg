<?php

namespace MyAgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mkhodroo\AgencyInfo\Controllers\GetAgencyController;

class EditMyAgencyInfoController extends Controller
{

    public static function form($parent_id){
        $agency_fields = GetAgencyController::getByParentId($parent_id);
        return view('MyAgencyViews::edit', compact('agency_fields'));
    }

}
