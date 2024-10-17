<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

class MapAgencyGuildCatagoryController extends Controller
{
    public static function p2e($guild_catagory){
        $array = [
            "شارژ گازهای صنعتی و فروش گازهای طبی" => "sale-and-charging-insdustrial-gas",
            "خرده فروشی گازهای طبی و صنعتی" => "retail",
            "شارژ سیلندرهای آتش نشانی" => "charging-fire-cylenders",
        ];

        return isset($array[$guild_catagory]) ? $array[$guild_catagory] : $guild_catagory;
    }
}
