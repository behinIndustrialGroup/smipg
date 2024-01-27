<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\CorrespondenceSystem\Models\Activity;
use Mkhodroo\CorrespondenceSystem\Models\Inbox;
use Mkhodroo\DateConvertor\Controllers\SDate;

class ShowInboxController extends Controller
{
    public static function list(){
        return [
            'data' => Inbox::where('user_id', Auth::id())->whereNull('done_date')->get()->each(function($row){
                $row->letter_info = $row->letterInfo();
            })
        ];
    }

    public static function listForm(){
        return view('CSViews::inbox.list');
    }

    public static function showLetter($inbox_id,$letter_id){
        $letter = LetterController::get($letter_id);
        return view('CSViews::inbox.show-letter')->with([
            'inbox_id' => $inbox_id,
            'letter_id' => $letter->id,
            'letter_info' => LetterController::get($letter_id),
            'template' => $letter->template_id,
            'receiver_options' => UserRoleController::list()['data'],
            'signs' => SignController::getUserSigns(),
        ]);
    }


}