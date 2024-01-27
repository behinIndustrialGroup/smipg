<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mkhodroo\CorrespondenceSystem\Controllers\LetterController;

class Inbox extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "inbox";
    protected $fillable = [
        'letter_id', 'user_id', 'status', 'for', 'done_date'
    ];

    function letterInfo(){
        return LetterController::get($this->letter_id);
    }
}