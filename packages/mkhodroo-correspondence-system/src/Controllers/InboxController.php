<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\CorrespondenceSystem\Models\Activity;
use Mkhodroo\CorrespondenceSystem\Models\Inbox;
use Mkhodroo\DateConvertor\Controllers\SDate;

class InboxController extends Controller
{
    public static function create($letter_id, $user_id, $status, $for){
        return Inbox::create([
            'letter_id' => $letter_id,
            'user_id' => $user_id,
            'status' => $status,
            'for' => $for
        ]);
    }

    public static function done($id) {
        $row  = Inbox::find($id);
        $row->done_date = date('Y-m-d H:i:s');
        $row->save();
    }
}