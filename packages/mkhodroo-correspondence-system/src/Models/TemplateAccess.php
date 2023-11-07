<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateAccess extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "";
    protected $fillable = [
        
    ];
}