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

class FinExcelController extends Controller
{
    protected static $index = 0;
    public static function returnIndex(){
        return self::$index;
    }

    public function index()
    {
        return view('ExcelView::Fin.index');
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
            $query = DB::table('agency_info as a1')
            ->join('agency_info as a2', function ($join) {
                $join->on('a1.parent_id', '=', 'a2.parent_id')
                    ->where('a1.key', 'guild_number');
                    // ->where('a2.key', 'file_number');
            });
            $i = 0;
            $numberOfUpdatedRows = 0;
            $numberOfAddedRows = 0;
            $errorRows = [];
            $insertData = [];
            $index = $request->last_row_index +1;
            for ( $index; $index <= count($xlsx->rows()); $index++) {
                if ($index == 0) {
                    continue;
                }
                $row = $xlsx->rows()[$index-1];
                $data = array_combine($header, $row);
                // $data['guild_catagory'] = MapAgencyGuildCatagoryController::p2e($data['guild_catagory']);
                // $data['city'] = CityController::create($data['province'], $data['city'])->id;
                // $data['province'] = ProvinceController::getByName($data['province'])->id;
                // $data['last_request_type'] = MapAgencyInfoController::mapLastRequestType($data['last_request_type']);
                // $data['new_status'] = MapAgencyInfoController::mapLastStatus($data['new_status']);
                // $data['catagory'] = MapAgencyInfoController::mapCategory($data['catagory']);
                // $data = ExcelController::headerRenameAndFilter($data);


                $searchQuery = (clone $query)
                    ->where('a1.value', $data['guild_number'])
                    ->select('a1.parent_id')
                    ->first();
                $parentId = $searchQuery?->parent_id;

                if ($parentId) {
                    $insertData[] = [
                        'key' => 'payment',
                        'value' => json_encode(array(
                            'title' => trim($data['title']),
                            'price' => trim($data['price']),
                            'date' => trim($data['date']),
                            'type' => trim($data['type']),
                            'file' => null
                        )),
                        'parent_id' => $parentId
                    ];
                    $numberOfUpdatedRows++;
                } else {
                    // $searchQuery = (clone $query)
                    //     ->where('a2.value', trim($data['file_number']))
                    //     ->select('a1.parent_id')
                    //     ->first();
                    // $parentId = $searchQuery?->parent_id;
                    // if($parentId){
                        $errorRows[] = [ 'row' => $index, 'guild_number' => $data['guild_number'] ];
                    // }
                    // else{
                    //     $parentRecord = AgencyInfo::create(
                    //         [
                    //             'key' => 'guild_catagory',
                    //             'value' => $data['guild_catagory'],
                    //             'parent_id' => null
                    //         ]
                    //     );

                    //     $parentId = $parentRecord->id;

                    //     $parentRecord->parent_id = $parentId;
                    //     $parentRecord->save();

                    //     foreach ($data as $key => $value) {
                    //         if ($key !== 'guild_catagory') {
                    //             // AgencyInfo::create([
                    //             //     'key' => $key,
                    //             //     'value' => trim($value),
                    //             //     'parent_id' => $parentId
                    //             // ]);
                    //             $insertData[] = [
                    //                 'key' => $key,
                    //                 'value' => trim($value),
                    //                 'parent_id' => $parentId
                    //             ];
                    //         }
                    //     }
                    //     $numberOfAddedRows++;
                    // }

                }
                $i++;
            }
            foreach($insertData as $row){
                AgencyController::createNew($row['key'], trim($row['value']), $row['parent_id']);
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
            'شماره صنفی' => 'guild_number',
            'عنوان پرداختی' => 'title',
            'مبلغ پرداختی' => 'price',
            'روش پرداخت' => 'type',
            'تاریخ پرداختی' => 'date',
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
