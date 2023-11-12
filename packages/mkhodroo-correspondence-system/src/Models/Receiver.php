<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receiver extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "letter_receivers";
    protected $fillable = [
        'letter_id', 'user_id', 'name'
    ];
}