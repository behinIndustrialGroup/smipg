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
            'data' => $row,
            'cities' => CityController::all()
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
        if($r->file('operation_license') !== null){
            $data['operation_license'] = FileController::store(
                $r->file('operation_license'),
                config('nerkhnameh_config.nerkhnameh_filess') . '/nerkhnameh' );
            if( $data['operation_license']['status'] !== 200 ){
                return response(
                    trans("nerkhnameh file") . ' ' . $data['operation_license']['message'],
                    $data['operation_license']['status']
                );
            }
            $data['operation_license'] = $data['operation_license']['dir'];
        }else{
            unset($data['operation_license']);
        }
        return NerkhnamehModel::where(
            'id', $r->id
        )->update($data);
    }

    
    
    

}


