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


class RegisterController extends Controller{
    public function registerForm(){
        return view('NerkhnamehView::register')->with([
            'cities' => CityController::all()
        ]);
    }

    public function register(Request $r) {
        $r->validate([
            'guild_name' => 'required|string',
            'fullname' => 'required|string',
            'national_id' => 'required|digits:10',
            'catagory' => 'required|string',
            'city_id' => 'required|numeric',
            'guild_number' => 'required|numeric',
            'tel' => 'required|digits:11',
            'mobile' => 'required|digits:11',
            'address' => 'required|string',
            'personal_image_file' => 'required',
            'commitment_file' => 'required'
        ]);
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



