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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SoapClient;


class QrCodeController extends Controller{
    public static function generate(){
        
        $qrCodes = [];
        $qrCodes['simple'] = QrCode::format('jpg')->size(150)->generate('https://crm.smipg.ir/');
        // $im = new Imagick();
        $file = fopen(public_path('qr-code.png'), 'wb');
        fwrite($file, $qrCodes['simple']);
        fclose($file);
        return $qrCodes['simple'];
    }

}


