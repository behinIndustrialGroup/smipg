<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public static function send($to, $patternCode, array $parameters)
    {
        $token = 'DQpEUMBqaEDlaiSohwpYy898gjmkmrx632XVrCOkPPg='; // جایگزین کنید
        $url = 'https://api.mediana.ir/sms/v1/send/pattern';

        $data = [
            // "clientRef" => "string",
            // "pluginType" => "Digits",
            "recipients" => [
                $to // شماره موبایل گیرنده
            ],
            "patternCode" => "$patternCode", // کد الگوی پیامک از پنل مدیانا
            "parameters" => $parameters
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: */*",
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo 'خطا در ارتباط: ' . curl_error($ch);
        } else {
            echo "کد وضعیت HTTP: $httpCode\n";
            echo "پاسخ: $response\n";
        }

        curl_close($ch);
    }
}
