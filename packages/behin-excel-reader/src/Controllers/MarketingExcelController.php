<?php

namespace ExcelReader\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mkhodroo\AgencyInfo\Controllers\AgencyController;
use Mkhodroo\AgencyInfo\Controllers\MapAgencyGuildCatagoryController;
use Mkhodroo\AgencyInfo\Controllers\MapAgencyInfoController;
use Mkhodroo\AgencyInfo\Controllers\MapAgencyRequestTypeController;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\Cities\Controllers\ProvinceController;
use Modules\MarketingCard\App\Http\Controllers\MarketingCardController;

class MarketingExcelController extends Controller
{
    protected static $index = 0;
    public static function returnIndex(){
        return self::$index;
    }

    public function index()
    {
        return view('ExcelView::Marketing.index');
    }

    public static function read(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');

        if ($xlsx = ExcelReader::parse($file->getPathname())) {

            $header = $xlsx->rows()[0];
            $header = self::headerRenameAndFilter($header);
            $numberOfUpdatedRows = 0;
            $numberOfAddedRows = 0;
            $errorRows = [];
            $insertData = [];
            $index = 0;
            for ( $index; $index <= count($xlsx->rows()); $index++) {
                if ($index == 0) {
                    continue;
                }
                $row = $xlsx->rows()[$index-1];
                $data = array_combine($header, $row);

                $r = new Request([
                    'firstName' => trim($data['firstName']),
                    'lastName' => trim($data['lastName']),
                    'nationalId' => trim($data['nationalId']),
                    'fatherName' => trim($data['fatherName']),
                    'bornDate' => trim($data['bornDate']),
                    'guildUnit' => trim($data['guildUnit']),
                    'guildNumber' => trim($data['guildNumber']),
                    'province' => trim($data['province']),
                    'city' => trim($data['city']),
                ]);

                MarketingCardController::store($r);
            }
        } else {
            echo ExcelReader::parseError();
        }
    }

    public static function headerRenameAndFilter($array)
    {

        $keysToRename = [
            'نام' => 'firstName',
            'نام خانوادگی' => 'lastName',
            'نام پدر' => 'fatherName',
            'کد ملی' => 'nationalId',
            'تاریخ تولد' => 'bornDate',
            'واحد صنفی' => 'guildUnit',
            'شناسه صنفی' => 'guildNumber',
            'استان' => 'province',
            'شهرستان' => 'city',
        ];

        $result = [];
        foreach ($array as $ar) {
            if (isset($keysToRename[$ar])) {
                $result[] = $keysToRename[$ar];
            } else {
                $result[] = $ar;
            }
        }
        return $result;

        foreach ($keysToRename as $oldKey => $newKey) {
            if (array_key_exists($oldKey, $array)) {
                $result[$newKey] = $array[$oldKey];
            }
        }

        return $result;
    }
}
