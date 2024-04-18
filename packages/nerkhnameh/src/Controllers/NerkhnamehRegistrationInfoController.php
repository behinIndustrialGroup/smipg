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
            'data' => self::get($r->id),
        ]);
    }

    public static function edit(Request $r){
        $data = $r->all();
        if($r->file('nerkhnameh_file') !== null){
            $data['nerkhnameh_file'] = FileController::store(
                $r->file('nerkhnameh_file'),
                config('nerkhnameh_config.nerkhnameh_files') . '/nerkhnameh' );
            if( $data['nerkhnameh_file']['status'] !== 200 ){
                return response(
                    trans("nerkhnameh file") . ' ' . $data['nerkhnameh_file']['message'],
                    $data['nerkhnameh_file']['status']
                );
            }
            $data['nerkhnameh_file'] = $data['nerkhnameh_file']['dir'];
        }
        return NerkhnamehModel::where(
            'id', $r->id
        )->update($data);
    }

    public static function getByNidMobileGuildNumber($nid, $mobile, $guild_number){
        return NerkhnamehModel::where(
            'national_id', $nid
        )->where(
            'mobile', $mobile
        )->where(
            'guild_number', $guild_number
        )->first();
    }

}


