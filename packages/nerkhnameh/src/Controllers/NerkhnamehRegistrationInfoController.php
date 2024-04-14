<?php 

namespace Mkhodroo\Nerkhnameh\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\MkhodrooProcessMaker\Models\PMCase;
use Mkhodroo\Nerkhnameh\Models\NerkhnamehModel;
use SoapClient;


class NerkhnamehRegistrationInfoController extends Controller{
    public function listForm(){
        return view('NerkhnamehView::registration-info.list')->with([
            'cities' => CityController::all()
        ]);
    }

    public function list(){
        return [
            'data' => NerkhnamehModel::get()
        ];
    }

    public static function get($id){
        return NerkhnamehModel::find($id);
    }

    public static function getView(Request $r){
        return view('NerkhnamehView::registration-info.edit')->with([
            'data' => self::get($r->id)
        ]);
    }

}


