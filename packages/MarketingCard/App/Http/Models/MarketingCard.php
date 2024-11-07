<?php

namespace Modules\MarketingCard\App\Http\Models;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MarketingCard extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'marketing_cards';


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'firstName',
        'lastName',
        'nationalId',
        'fatherName',
        'issueDate',
        'expiryDate',
        'qrCodeFilePath'
    ];

    public function issueDate($to = 'gregorian'){
        if($this->issueDate){
            if($to == 'persian'){
                return Verta::createTimestamp($this->issueDate/1000)->format('Y-m-d');
            }
            return Carbon::createFromTimestamp($this->issueDate/1000)->format('Y-m-d');

        }
    }

    public function expiryDate($to = 'gregorian'){
        if($this->expiryDate){
            if($to == 'persian'){
                return Verta::createTimestamp($this->expiryDate/1000)->format('Y-m-d');
            }
            return Carbon::createFromTimestamp($this->expiryDate/1000)->format('Y-m-d');
        }
    }
}
