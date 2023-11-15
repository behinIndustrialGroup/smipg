<?php

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mkhodroo\CorrespondenceSystem\Models\Letter;
use Mkhodroo\DateConvertor\Controllers\SDate;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

class LetterController extends Controller
{
    public static function get($id)
    {
        return Letter::find($id);
    }
    public static function selectLetterTemplateForm()
    {
        return view('CSViews::letter.select-template')->with([
            'templates' => TemplateController::templatesThatUserCanCreated(),
        ]);
    }

    public static function selectLetterTemplate(Request $r)
    {
        $letter = new Letter();
        $letter->template_id = $r->template_id;
        $letter->file = TemplateController::get($r->template_id)->file;
        $letter->body = TemplateController::get($r->template_id)->file;
        $letter->save();
        return self::createForm($letter->id, $letter->template_id);
    }

    public static function createForm($letter_id, $template_id)
    {
        return view('CSViews::letter.create')->with([
            'letter_id' => $letter_id,
            'template' => TemplateController::get($template_id),
            'receiver_options' => UserRoleController::list()['data'],
            'signs' => SignController::getUserSigns(),
        ]);
    }
    public static function create(Request $r)
    {
        $letter = Letter::find($r->id);
        if($letter->sign_id){
            return response(trans("You Cant Edit Body After Signing"), 300);
        }
        $letter->title = $r->title;
        $letter->save();
        // $file = self::putContentToTemplate($letter->id, $r->receivers);
        foreach ($r->receivers as $receiver) {
            ReceiverController::create($letter->id, $receiver);
        }
        // $letter->file = $file;
        // $letter->save();
        if ($r->file('file')) {
            $letter->body = base64_encode(file_get_contents($r->file('file')->getRealPath()));
            $letter->save();
        }
        return $letter;
    }
    public static function editForm(Request $r)
    {
        return view('CSViews::letter.edit')->with([
            'templates' => TemplateController::list()['data'],
            'roles' => RoleController::list()['data'],
            'access' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r)
    {
        $row = self::get($r->id);
        $row->template_id = $r->template_id;
        $row->role_id = $r->role_id;
        $row->create = $r->create ? 1 : 0;
        $row->numbering = $r->numbering ? 1 : 0;
        $row->signing = $r->signing ? 1 : 0;
        $row->save();
        return $row;
    }

    public static function download($id)
    {
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=template.docx");
        readfile('data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,' . self::get($id)->file);
    }

    public static function putContentToTemplate($letter_id)
    {
        $letter = self::get($letter_id);
        $receivers = ReceiverController::getByLetterId($letter->id);
        $file = fopen(public_path('file.docx'), 'wb');
        fwrite($file, base64_decode($letter->body));
        fclose($file);

        $phpword = new TemplateProcessor(public_path('file.docx'));
        if ($letter->number) {
            $phpword->setValue('Number', $letter->number);
            $phpword->setValue('Date', $letter->date);
        }
        $phpword->setValue('Title', $letter->title);
        $phpword->setValue('SignerName', Auth::user()->name);
        $receiversStr = '';
        foreach ($receivers as $receiver) {
            $receiversStr .= $receiver->name . '<w:br/>';
        }
        $phpword->setValue('Receivers', $receiversStr);
        $base64_image = SignController::get($letter->sign_id)->file;
        $image = base64_decode($base64_image);
        file_put_contents(public_path('sign.png'), $image);
        $image = public_path('sign.png');
        $phpword->setImageValue('Sign', $image);
        $phpword->saveAs(public_path('edited.docx'));
        $letter->file = base64_encode(file_get_contents(public_path('edited.docx')));
        $letter->save();
        unlink(public_path('edited.docx'));
        unlink(public_path('file.docx'));
    }
}
