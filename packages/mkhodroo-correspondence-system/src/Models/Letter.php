<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "letters";
    protected $fillable = [
        'template_id', 'title', 'body', 'tags', 'number', 'date', 'file'
    ];
}