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
            return response("", 404);
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
            'price' => 'required',
            'price_payment_file' => 'required'
        ]);
        return $r->all();
        $data = $r->except('_token', 'personal_image_file', 'commitment_file');
        if( $r->file('personal_image_file') !== null ){
            $data['personal_image_file'] = FileController::store(
                $r->file('personal_image_file'),
                config('nerkhnameh_config.nerkhnameh_files') );
            if( $data['personal_image_file']['status'] !== 200 ){
                return response(
                    trans("Personal image") . ' ' . $data['personal_image_file']['message'],
                    $data['personal_image_file']['status']
                );
            }
            $data['personal_image_file'] = $data['personal_image_file']['dir'];
        }
        if( $r->file('commitment_file') !== null ){
            $data['commitment_file'] = FileController::store(
                $r->file('commitment_file'),
                config('nerkhnameh_config.nerkhnameh_files') );
            if( $data['commitment_file']['status'] !== 200 ){
                return response(
                    trans("Commitment Image") . ' ' . $data['commitment_file']['message'], 
                    $data['commitment_file']['status']
                );
            }
            $data['commitment_file'] = $data['commitment_file']['dir'];
        }
        NerkhnamehModel::create($data);
    }
}



