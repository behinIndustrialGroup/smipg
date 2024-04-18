<?php

namespace Mkhodroo\Nerkhnameh\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\Template;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Str;
use Mkhodroo\Nerkhnameh\Models\NerkhnamehModel;

class TemplateController extends Controller
{
    public static function get($id)
    {
        return Template::find($id);
    }

    public static function createNerkhnameh(Request $r){
        $row = NerkhnamehRegistrationInfoController::get($r->id);
        $row->unique_id = self::createUniqueId();
        $row->save();
        return self::putContentToTemplate($row);
    }

    public static function createUniqueId() {
        $r = Str::random(10);
        if(NerkhnamehModel::where('unique_id', $r)->first()){
            self::createUniqueId();
        }
        return $r;
    }

    public static function putContentToTemplate($row)
    {
        // $row = NerkhnamehRegistrationInfoController::get($row);
        $qr_code = QrCodeController::generate(config('nerkhnameh_config.link') . $row->unique_id);
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
        $image = public_path('qr-code.png');
        $phpword->setImageValue('qr_code', $image);
        
        // $receiversStr = '';
        // foreach($receivers as $receiver){
        //     $receiversStr .= $receiver . '<w:br/>';
        // }
        // $phpword->setValue('Receivers', $receiversStr);

        $nerkhnameh_name = config('nerkhnameh_config.nerkhnameh_files') . "/nerkhnameh/$row->unique_id.docx";
        $phpword->saveAs(public_path($nerkhnameh_name));
        return "public/$nerkhnameh_name";
        return base64_encode(file_get_contents(public_path('edited.docx')));
    }
}
