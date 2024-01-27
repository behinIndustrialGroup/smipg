<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "letter_activities";
    protected $fillable = [
        'letter_id', 'user_id', 'action', 'done_date'
    ];
}