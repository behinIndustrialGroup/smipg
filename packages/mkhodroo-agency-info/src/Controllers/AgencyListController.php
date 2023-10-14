<?php 

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

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
                $agency->$fields_key = AgencyInfo::where('parent_id', $agency->id)->where('key', "$fields_key")->first()?->value;
            }
        }
        return ['data' =>$agencies];
    }
}
