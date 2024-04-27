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

    public function homeForm(){
        return view('NerkhnamehView::home')->with([
            'cities' => CityController::all()
        ]);
    }

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
        if(
            NerkhnamehRegistrationInfoController::getByNidMobileGuildNumberCatagory(
                $r->national_id, $r->mobile, $r->guild_number, $r->catagory)
        ){
            return ;
        }
        if($r->catagory === config('nerkhnameh_config.catagory')[4] and $r->file('operation_license') === null){
            return response(trans("Operation License Image must be uploaded"), 402);
        }
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
        if( $r->file('operation_license') !== null ){
            $data['operation_license'] = FileController::store(
                $r->file('operation_license'),
                config('nerkhnameh_config.nerkhnameh_files') );
            if( $data['operation_license']['status'] !== 200 ){
                return response(
                    trans("Operation License Image") . ' ' . $data['operation_license']['message'], 
                    $data['operation_license']['status']
                );
            }
            $data['operation_license'] = $data['operation_license']['dir'];
        }
        NerkhnamehModel::create($data);
    }

    public function convert($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
        
        return $englishNumbersOnly;
    }
}



