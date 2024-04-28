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


class EditRequestController extends Controller{
    public function findForm(){
        return view('NerkhnamehView::edit-request.find');
    }


    public function find(Request $r){
        $row = NerkhnamehRegistrationInfoController::getByNidMobileGuildNumberCatagory(
            $r->national_id, $r->mobile, $r->guild_number, $r->catagory
        );
        if(!$row){
            return response(trans("Not Found"), 402);
        }
        $cantModify  = EditInfoValidationController::cantModify($row->id);
        if($cantModify){
            return $cantModify;
        }
        return view('NerkhnamehView::edit-request.edit')->with([
            'data' => $row
        ]);
    }

    public static function edit(Request $r){
        $data = $r->all();
        if($r->file('personal_image_file') !== null){
            $data['personal_image_file'] = FileController::store(
                $r->file('personal_image_file'),
                config('nerkhnameh_config.nerkhnameh_filess') . '/nerkhnameh' );
            if( $data['personal_image_file']['status'] !== 200 ){
                return response(
                    trans("nerkhnameh file") . ' ' . $data['personal_image_file']['message'],
                    $data['personal_image_file']['status']
                );
            }
            $data['personal_image_file'] = $data['personal_image_file']['dir'];
        }else{
            unset($data['personal_image_file']);
        }
        if($r->file('operaation_license') !== null){
            $data['operaation_license'] = FileController::store(
                $r->file('operaation_license'),
                config('nerkhnameh_config.nerkhnameh_filess') . '/nerkhnameh' );
            if( $data['operaation_license']['status'] !== 200 ){
                return response(
                    trans("nerkhnameh file") . ' ' . $data['operaation_license']['message'],
                    $data['operaation_license']['status']
                );
            }
            $data['operaation_license'] = $data['operaation_license']['dir'];
        }else{
            unset($data['operaation_license']);
        }
        return NerkhnamehModel::where(
            'id', $r->id
        )->update($data);
    }

    
    
    

}


