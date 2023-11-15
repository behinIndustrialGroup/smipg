<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sign extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "signs";
    protected $fillable = [
        'user_id', 'file', 'name'
    ];
}