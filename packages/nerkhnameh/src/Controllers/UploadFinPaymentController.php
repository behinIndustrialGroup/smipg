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


class UploadFinPaymentController extends Controller{
    public function uploadForm(){
        return view('NerkhnamehView::upload-fin-payment')->with([
            'cities' => CityController::all()
        ]);
    }

    public function check(Request $r){
        $r->validate([
            'national_id' => 'required|digits:10',
            'guild_number' => 'required|numeric',
            'mobile' => 'required|digits:11'
        ]);

        $data = NerkhnamehModel::where(
            'national_id' , $r->national_id
        )->where(
            'guild_number', $r->guild_number
        )->where(
            'mobile', $r->mobile
        )->first();

        if(!$data){
            return response(trans("not found"), 404);
        }
        return view('NerkhnamehView::fin-details-div')->with([
            'data' => $data
        ]);
    }

    public function upload(Request $r) {
        $r->validate([
            'national_id' => 'required|digits:10',
            'guild_number' => 'required|numeric',
            'mobile' => 'required|digits:11',
            'price_payment_file' => 'required'
        ]);
        $row = NerkhnamehRegistrationInfoController::getByNidMobileGuildNumberCatagory(
            $r->national_id,
            $r->mobile,
            $r->guild_number,
            $r->catagory
        );
        $upload = FileController::store(
            $r->file('price_payment_file'),
            config('nerkhnameh_config.nerkhnameh_files') 
        );
        if( $upload['status'] !== 200 ){
            return response(
                trans("Price Payment") . ' ' . $upload['message'],
                $upload['status']
            );
        }
        $row->price_payment_file = $upload['dir'];
        $row->save();
    }
}



