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


class EditInfoValidationController extends Controller{

    public static function cantModify($id){
        $row = NerkhnamehRegistrationInfoController::get($id);
        if(!$row){
            return response(trans("Not Found"), 402);
        }
        if($row->nerkhnameh_word_file){
            return response(
                trans("You cant edit this record because: ").
                trans("Nerkhnameh Is Generated"), 
                402
            );
        }
    }

    
    

}


