<?php

namespace Mkhodroo\Nerkhnameh\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NerkhnamehModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = "nerkhnameh";
    protected $fillable = [
        'guild_name', 'fullname', 'national_id', 'catagory', 'operation_license', 'mobile', 'tel', 
        'guild_number', 'city_id', 'address', 'personal_image_file', 'commitment_file', 'price', 
        'price_payment_file', 'fin_validation', 'nerkhnameh_file', 'unique_id', 'nerkhnameh_word_file',
        'fin_detail'
    ];
}
