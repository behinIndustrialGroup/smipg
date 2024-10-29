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

class ExcelController extends Controller
{
    public function input()
    {
        return view('ExcelView::input');
    }

    public static function read(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');

        if ($xlsx = ExcelReader::parse($file->getPathname())) {

            $header = $xlsx->rows()[0];
            $header = ExcelController::headerRenameAndFilter($header);
            $query = DB::table('agency_info as a1')
            ->join('agency_info as a2', function ($join) {
                $join->on('a1.parent_id', '=', 'a2.parent_id')
                    ->where('a1.key', 'national_id')
                    ->where('a2.key', 'file_number');
            });
            $i = 0;
            $numberOfUpdatedRows = 0;
            $numberOfAddedRows = 0;
            $errorRows = [];
            $insertData = [];
            foreach ($xlsx->rows() as $index => $row) {
                if ($index == 0) {
                    continue;
                }

                $data = array_combine($header, $row);
                $data['guild_catagory'] = MapAgencyGuildCatagoryController::p2e($data['guild_catagory']);
                $data['city'] = CityController::create($data['province'], $data['city'])->id;
                $data['province'] = ProvinceController::getByName($data['province'])->id;
                $data['last_request_type'] = MapAgencyInfoController::mapLastRequestType($data['last_request_type']);
                $data['new_status'] = MapAgencyInfoController::mapLastStatus($data['new_status']);
                $data['catagory'] = MapAgencyInfoController::mapCategory($data['catagory']);
                // $data = ExcelController::headerRenameAndFilter($data);


                $searchQuery = (clone $query)
                    ->where('a1.value', $data['national_id'])
                    ->where('a2.value', $data['file_number'])
                    ->select('a1.parent_id')
                    ->first();
                $parentId = $searchQuery?->parent_id;

                if ($parentId) {
                    foreach ($data as $key => $value) {
                        // AgencyController::create($parentId, $key, trim($value));
                        $insertData[] = [
                            'key' => $key,
                            'value' => trim($value),
                            'parent_id' => $parentId
                        ];
                    }
                    $numberOfUpdatedRows++;
                } else {
                    $searchQuery = (clone $query)
                        ->where('a2.value', trim($data['file_number']))
                        ->select('a1.parent_id')
                        ->first();
                    $parentId = $searchQuery?->parent_id;
                    if($parentId){
                        $errorRows[] = [ 'row' => $index+1, 'file_number' => $data['file_number'] ];
                    }
                    else{
                        $parentRecord = AgencyInfo::create(
                            [
                                'key' => 'guild_catagory',
                                'value' => $data['guild_catagory'],
                                'parent_id' => null
                            ]
                        );

                        $parentId = $parentRecord->id;

                        $parentRecord->parent_id = $parentId;
                        $parentRecord->save();

                        foreach ($data as $key => $value) {
                            if ($key !== 'guild_catagory') {
                                // AgencyInfo::create([
                                //     'key' => $key,
                                //     'value' => trim($value),
                                //     'parent_id' => $parentId
                                // ]);
                                $insertData[] = [
                                    'key' => $key,
                                    'value' => trim($value),
                                    'parent_id' => $parentId
                                ];
                            }
                        }
                        $numberOfAddedRows++;
                    }

                }
                $i++;
            }
            foreach($insertData as $row){
                AgencyController::create($row['parent_id'], $row['key'], trim($row['value']));
            }
            // AgencyInfo::upsert($insertData, ['key', 'parent_id'], ['value']);
            return response()->json([
                'msg' => "تعداد $i ردیف ذخیره شد",
                "numberOfAddedRows" => $numberOfAddedRows,
                "numberOfUpdatedRows" => $numberOfUpdatedRows,
                "errorRows" => $errorRows
            ]);
        } else {
            echo ExcelReader::parseError();
        }
    }

    public static function headerRenameAndFilter($array)
    {

        $keysToRename = [
            'کدملی' => 'national_id',
            'کد پستی' => 'postal_code',
            'موبایل' => 'mobile',
            'تلفن' => 'phone',
            'نام محل صنفی' => 'guild_or_legal_name',
            'نام' => 'firstname',
            'نام خانوادگی' => 'lastname',
            'تاریخ آخرین درخواست' => 'last_request_date',
            'استان' => 'province',
            'شهر' => 'city',
            'دسته بندی' => 'catagory',
            'نوع شخص' => 'person_type',
            'نوع درخواست' => 'last_request_type',
            'آخرین ارجاع' => 'last_referral',
            'کارشناس بررسی' => 'reviewer',
            'وضعیت جدید' => 'new_status',
            'رسته' => 'guild_catagory',
            'شماره پرونده' => 'file_number'
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
