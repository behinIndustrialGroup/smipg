<?php 

namespace Mkhodroo\AgencyInfo\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = "cities";
    protected $fillable = [
        'key', 'value', 'parent_id', 'desciption'
    ];

    // function role() {
    //     return 
    // }
}