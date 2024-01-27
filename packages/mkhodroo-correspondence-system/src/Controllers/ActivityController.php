<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\CorrespondenceSystem\Models\Activity;
use Mkhodroo\DateConvertor\Controllers\SDate;

class ActivityController extends Controller
{
    public static function create($letter_id, $action){
        return Activity::create([
            'letter_id' => $letter_id,
            'user_id' => Auth::id(),
            'action' => $action
        ]);
    }
    public static function get($letter_id){
        return Activity::where('letter_id', $letter_id)->get()->each(function($row){
            $row->string = User::find($row->user_id)?->name . ' : ' . trans($row->action);
            $datetime = explode(' ',$row->created_at);
            $date = $datetime[0];
            $time = $datetime[1];
            $row->shDate = (new SDate())->toShaDate($date);
            $row->time = $time;
        });
    }
    public static function numbering(Request $r){
        $letter = LetterController::get($r->letter_id);
        if($letter->number){
            return response(trans("Letter Has Number"), 300);
        }
        $template = TemplateController::get($letter->template_id);
        $number = NumberingFormatController::Numbering($template->numbering_format_id);
        $letter->number = $number;
        $letter->date = (new SDate())->toShaDate(date('Y-m-d'));
        $letter->save();
        self::create($r->letter_id, 'Numbering');
    }

    public static function signing(Request $r){
        $letter = LetterController::get($r->letter_id);
        if(!TemplateAccessController::userCanSignTemplate($letter->template_id)){
            return response(trans("You Can not Sign This Letter"), 300);
        }
        if(!$letter->number){
            $r= new Request([
                'letter_id' => $letter->id
            ]);
            self::numbering($r);
        }
        if($letter->sign_id){
            return response(trans("Letter Signed Before."), 300);
        }
        $letter->sign_id = $r->sign_id;
        $letter->save();
        LetterController::putContentToTemplate($letter->id);
        self::create($r->letter_id, 'Signing');
    }

    public static function unsigning(Request $r){
        $letter = LetterController::get($r->letter_id);
        if(!TemplateAccessController::userCanSignTemplate($letter->template_id)){
            return response(trans("You Can not Unsign This Letter"), 300);
        }
        $letter->number = '';
        $letter->date = '';
        $letter->sign_id = null;
        $letter->file = $letter->body;
        $letter->save();
        self::create($r->letter_id, 'Unsigning');
    }
}