<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\DateConvertor\Controllers\SDate;

class AgencyListController extends Controller
{
    public static function view()
    {
        return view('AgencyView::list');
    }

    public static function list()
    {
        $agencies =  AgencyInfo::where('parent_id', DB::raw('id'))->get();

        $agencies =  AgencyInfo::where('parent_id', DB::raw('id'))->get()->each(function ($agency) {
            $agency->firstname = GetAgencyController::getByKey($agency->id, 'firstname')?->value;
            $agency->lastname = GetAgencyController::getByKey($agency->id, 'lastname')?->value;
            $agency->guild_catagory = __(GetAgencyController::getByKey($agency->id, 'guild_catagory')?->value);
            $agency->catagory = __(GetAgencyController::getByKey($agency->id, 'catagory')?->value);
            $agency->national_id = GetAgencyController::getByKey($agency->id, 'national_id')?->value;
            $agency->status = GetAgencyController::getByKey($agency->id, 'status')?->value;
            $agency->province_detail = CityController::getById($agency->province);
            $agency->created_at = (new SDate())->toShaDate(explode(" ", $agency->created_at)[0]);

        });
        // foreach($agencies as $agency){
        //     // return "agency_info.agency.$agency->value";
        //     foreach(config("agency_info.agency.$agency->value")['fields'] as $fields_key => $fields_value){
        //         $agency->$fields_key = self::getByKey($agency->id, $fields_key)?->value;
        //         if($fields_key === 'province'){
        //             $agency->province_detail = CityController::getById($agency->$fields_key);
        //         }
        //     }
        // }
        return ['data' => $agencies];
    }

}
