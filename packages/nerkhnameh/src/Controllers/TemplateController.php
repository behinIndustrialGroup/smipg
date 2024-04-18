<?php

namespace Mkhodroo\Nerkhnameh\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\Template;
use PhpOffice\PhpWord\TemplateProcessor;

class TemplateController extends Controller
{
    public static function get($id)
    {
        return Template::find($id);
    }

    public static function createNerkhnameh(Request $r){
        return self::putContentToTemplate($r->id);
    }

    public static function putContentToTemplate($nerkhnameh_id)
    {
        $row = NerkhnamehRegistrationInfoController::get($nerkhnameh_id);
        // return QrCodeController::generate();
        // $file = fopen(public_path('file.docx'), 'wb');
        // fwrite($file, base64_decode(self::get($template_id)->file));
        // fclose($file);
        $phpword = new TemplateProcessor(public_path('tozi-nerkh.docx'));
        $phpword->setValue('date', date('y-m-d'));
        $phpword->setValue('name', $row->fullname);
        $phpword->setValue('guild_name', $row->guild_name);
        $phpword->setValue('guild_number', $row->guild_number);
        $phpword->setValue('tel', $row->tel);
        $phpword->setValue('mobile', $row->mobile);
        $phpword->setValue('address', $row->address);
        $image = public_path('qr-code.svg');
        $phpword->setImageValue('qr_code', $image);
        
        // $receiversStr = '';
        // foreach($receivers as $receiver){
        //     $receiversStr .= $receiver . '<w:br/>';
        // }
        // $phpword->setValue('Receivers', $receiversStr);
        $phpword->saveAs(public_path('edited.docx'));
        return base64_encode(file_get_contents(public_path('edited.docx')));
    }
}
