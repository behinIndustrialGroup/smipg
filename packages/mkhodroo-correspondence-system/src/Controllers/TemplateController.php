<?php

namespace Mkhodroo\CorrespondenceSystem\Controllers;

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
    public static function listForm()
    {
        return view('CSViews::template.list');
    }
    public static function templatesThatUserCanCreated(){
        $template_id = TemplateAccessController::getTemplatesThatHasCreateAccessForLoginUser();
        return Template::whereIn('id', $template_id)->get();
    }
    public static function list()
    {
        return ['data' => Template::get()->each(function ($row) {
            $row->numbering_format = NumberingFormatController::get($row->numbering_format_id)->name;
        })];
    }
    public static function createForm()
    {
        return view('CSViews::template.create')->with([
            'numbering_formats' => NumberingFormatController::list()['data']
        ]);
    }
    public static function create(Request $r)
    {
        return Template::create([
            'name' => $r->name,
            'file' => base64_encode(file_get_contents($r->file('file')->getRealPath())),
            'numbering_format_id' => $r->numbering_format_id
        ]);
    }
    public static function editForm(Request $r)
    {
        return view('CSViews::template.edit')->with([
            'numbering_formats' => NumberingFormatController::list()['data'],
            'template' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r)
    {
        $row = self::get($r->id);
        $row->name = $r->name;
        if ($r->file('file')) {
            $row->file = $r->file;
        }
        $row->numbering_format_id = $r->numbering_format_id;
        $row->save();
        return $row;
    }

    public static function download($id)
    {
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/wav");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=template.docx");
        readfile('data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,' . TemplateController::get($id)->file);
    }

    public static function putContentToTemplate($template_id, $title, array $receivers)
    {
        $file = fopen(public_path('file.docx'), 'wb');
        fwrite($file, base64_decode(self::get($template_id)->file));
        fclose($file);
        $phpword = new TemplateProcessor(public_path('file.docx'));
        $phpword->setValue('Title', $title);
        $receiversStr = '';
        foreach($receivers as $receiver){
            $receiversStr .= $receiver . '<w:br/>';
        }
        $phpword->setValue('Receivers', $receiversStr);
        $phpword->saveAs(public_path('edited.docx'));
        return base64_encode(file_get_contents(public_path('edited.docx')));
    }
}
