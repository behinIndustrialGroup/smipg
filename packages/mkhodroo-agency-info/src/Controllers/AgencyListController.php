<?php 

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;

class AgencyListController extends Controller
{
    public static function view(){
        return view('AgencyView::list');
    }

    public static function list(){
        $agencies =  AgencyInfo::where('parent_id', DB::raw('id'))->get();
        foreach($agencies as $agency){
            // return "agency_info.agency.$agency->value";
            foreach(config("agency_info.agency.$agency->value")['fields'] as $fields_key => $fields_value){
                $agency->$fields_key = self::getByKey($agency->id, $fields_key)?->value;
                if($fields_key === 'province'){
                    $agency->province_detail = CityController::getById($agency->$fields_key);
                }
            }
        }
        return ['data' =>$agencies];
    }

    public static function getByKey($parent_id, $key){
        return AgencyInfo::where('parent_id', $parent_id)->where('key', "$key")->first();
    }
}
