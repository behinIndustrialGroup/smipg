<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "user_role";
    protected $fillable = [
        'user_id', 'role_id'
    ];
}