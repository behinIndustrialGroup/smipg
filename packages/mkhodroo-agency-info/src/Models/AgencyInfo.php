<?php 

namespace Mkhodroo\AgencyInfo\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyInfo extends Model
{
    public $table = "agency_info";
    protected $fillable = [
        'key', 'value', 'parent_id', 'desciption'
    ];

    // function role() {
    //     return 
    // }
}