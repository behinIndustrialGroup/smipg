<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

class MapAgencyInfoController extends Controller
{
    public static function mapLastRequestType($request_type){
        $array = [
            "صدور پروانه" => "صدور پروانه",
            "تمدید پروانه کسب" => "تمدید پروانه کسب",
            "تغییر نشانی" => "تغییر نشانی",
            "تغییر رسته" => "تغییر رسته",
            "تغییر مالکیت" => "تغییر مالکیت",
            "پرینت پروانه کسب" => "پرینت پروانه کسب",
            "دریافت شناسه یکتا" => "دریافت شناسه یکتا",
            "صدور" => "صدور پروانه",
            "تمدید" => "تمدید پروانه کسب",
            "تمدید پروانه" => "نمدید پروانه کسب"
        ];

        return isset($array[$request_type]) ? $array[$request_type] : null;
    }

    public static function mapLastStatus($data){
        $array = [
            "در حال بررسی" => "درحال بررسی",
            "درحال بررسی" => "درحال بررسی",
            "در حال تکمیل" => "در حال تکمیل",
            "درحال تکمیل" => "در حال تکمیل",
            "صادر شده" => "صادر شده",
            "صادرشده" => "صادر شده",
            "جدید" => "جدید",
            "حدید" => "جدید",
            "فاقد پروانه" => "فاقد پروانه",
            "فاقدپروانه" => "فاقد پروانه",
            "منقضی شده" => "منقضی شده",
        ];

        return isset($array[$data]) ? $array[$data] : $data;
    }
}
