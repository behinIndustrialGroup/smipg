<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateAccess extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "template_access";
    protected $fillable = [
        'template_id', 'role_id', 'create', 'numbering', 'siging'
    ];
}