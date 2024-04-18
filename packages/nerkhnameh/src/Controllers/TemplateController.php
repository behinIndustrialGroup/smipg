<?php

namespace Mkhodroo\Nerkhnameh\Controllers;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Facades\Verta;
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
        if(!$row->fin_validation){
            return response(trans("fin does not valid"), 402);
        }
        if($row->nerkhnameh_word_file){
            return ;
        }
        if(!$row->unique_id){
            $row->unique_id = self::createUniqueId();
        }
        $row->save();
        $nerkhnameh_word_file = self::putContentToTemplate($row);
        if(!$nerkhnameh_word_file){
            return response(trans("catagory is not valid"), 402);
        }
        $row->nerkhnameh_word_file = $nerkhnameh_word_file;
        $row->save();
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
        if(
            $row->catagory === config('nerkhnameh_config.catagory')[0] or
            $row->catagory === config('nerkhnameh_config.catagory')[1] or
            $row->catagory === config('nerkhnameh_config.catagory')[2] 
            ){
                $phpword = new TemplateProcessor(public_path('nerkh-tozi-temp.docx'));
        }
        elseif(
            $row->catagory === config('nerkhnameh_config.catagory')[3]
            ){
                $phpword = new TemplateProcessor(public_path('nerkh-fire-temp.docx'));
        }
        elseif(
            $row->catagory === config('nerkhnameh_config.catagory')[4] or
            $row->catagory === config('nerkhnameh_config.catagory')[5] 
            ){
                $phpword = new TemplateProcessor(public_path('nerkh-tolid-temp.docx'));
        }else{
            return ;
        }
        $date = verta();
        $phpword->setValue('date', "$date->year-$date->month-$date->day");
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
