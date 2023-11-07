<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "templates";
    protected $fillable = [
        'name', 'file', 'numbering_format_id'
    ];
}