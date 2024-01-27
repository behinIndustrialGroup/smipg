<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\CorrespondenceSystem\Models\Activity;
use Mkhodroo\CorrespondenceSystem\Models\Inbox;
use Mkhodroo\DateConvertor\Controllers\SDate;

class JumpController extends Controller
{
    public static function form(Request $r){
        return view('CSViews::jump.form')->with([
            'inbox_id' => $r->inbox_id,
            'letter_id' => $r->letter_id,
            'users' => UserRoleController::list()['data'],
        ]);
    }

    public static function jump(Request $r){
        $i=0;
        foreach($r->user_id as $user_id){
            InboxController::create($r->letter_id, $user_id, 'NEW', $r->for[$i]);
            ActivityController::create(
                $r->letter_id, 
                trans("Jump to "). User::find($user_id)?->name .' ' . trans("For ") . $r->for[$i]
            );
            $i++;
        }
        InboxController::done($r->inbox_id);
        return;
    }
}