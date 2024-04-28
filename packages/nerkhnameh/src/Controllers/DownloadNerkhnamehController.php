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


class DownloadNerkhnamehController extends Controller{
    public function downloadForm(){
        return view('NerkhnamehView::download');
    }


    public function check(Request $r){
        $data = NerkhnamehRegistrationInfoController::getByNidMobileGuildNumberCatagory(
            $r->national_id, 
            $r->mobile,
            $r->guild_number,
            $r->catagory
        );
        if(!$data){
            return response(trans("not found"), 402);
        }        
        return view('NerkhnamehView::download-details')->with([
            'data' => $data
        ]);
    }

}


