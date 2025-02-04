<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\AgencyInfo\Requests\AgencyInfoRequest;

class AgencyController extends Controller
{
    public static function docDir($id, $type = "fin")
    {
        $prefix = "user_docs";
        $user_dir = $prefix . "/u_" . $id . "/";

        //create user directory
        $full_path = public_path($user_dir);
        if (!is_dir($full_path)) {
            mkdir($full_path);
        }

        if ($type === 'doc') {
            return $user_dir . config('agency_info.doc_uploads');
        }
        if ($type === 'fin') {
            return $user_dir . config('agency_info.fin_uploads');
        }
        if ($type === 'ins') {
            return $user_dir . config('agency_info.ins_uploads');
        }
    }

    public static function view($parent_id)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $parent_id)->get();
        return view('AgencyView::edit')->with(['agency_fields' => $agency_fields]);
    }

    public static function edit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => str_replace(',', '', $value)
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = str_replace(',', '', $value);
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
    }

    public static function finEdit(Request $r)
    {
        $titles = $r->title;
        if ($titles) {
            foreach ($titles as $id => $title) {
                $file_dir = null;
                if (isset($r->file('file')[$id])) {
                    $file = FileController::store($r->file('file')[$id], self::docDir($id, 'fin'));
                    if ($file['status'] == 200) {
                        $file_dir = $file['dir'];
                    }
                }
                $updateData[] = [
                    'key' => 'payment',
                    'value' => json_encode(array(
                        'title' => $r->title[$id],
                        'price' => str_replace(',', '', $r->price[$id]),
                        'type' => $r->type[$id],
                        'date' => $r->date[$id],
                        'file' => $file_dir
                    )),
                    'id' => $id
                ];
            }

            foreach ($updateData as $row) {
                self::updateById($row['id'], $row['key'], $row['value']);
            }
        }
        if ($r->title_new) {
            $file_dir = null;
            if ($r->file('file_new')) {
                $file = FileController::store($r->file('file_new'), self::docDir($id, 'fin'));
                if ($file['status'] == 200) {
                    $file_dir = $file['dir'];
                }
            }
            $insertData = [
                'key' => 'payment',
                'value' => json_encode(array(
                    'title' => $r->title_new,
                    'price' => str_replace(',', '', $r->price_new),
                    'date' => $r->date_new,
                    'type' => $r->type_new,
                    'file' => $file_dir
                )),
                'parent_id' => $r->id
            ];
            self::createNew($insertData['key'], $insertData['value'], $insertData['parent_id']);
        }

        return $r->all();
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            //files
            if (gettype($r->$key) === 'object') {
                $value = FileController::store($r->file($key), self::docDir($r->id, 'fin'));
                if ($value['status'] !== 200) {
                    return response($value['message'], $value['status']);
                } else {
                    $value = $value['dir'];
                }
            }
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => str_replace(',', '', $value)
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = str_replace(',', '', $value);
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
        // return view('AgencyView::edit')->with([ 'agency_fields' => $agency_fields ]);
    }

    public static function InspectionEdit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();
        $data = $r->except('id');
        foreach ($data as $key => $value) {
            //files
            if (gettype($r->$key) === 'object') {
                $value = FileController::store($r->file($key), self::docDir($r->id, 'ins'));
                if ($value['status'] !== 200) {
                    return response($value['message'], $value['status']);
                } else {
                    $value = $value['dir'];
                }
            }
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => str_replace(',', '', $value)
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = str_replace(',', '', $value);
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
        // return view('AgencyView::edit')->with([ 'agency_fields' => $agency_fields ]);
    }

    public static function foremanEdit(Request $r)
    {
        $agency_fields =  AgencyInfo::where('parent_id', $r->id)->get();

        $data = $r->except('id');
        foreach ($data as $key => $value) {
            //files
            if (gettype($r->$key) === 'object') {
                $value = FileController::store($r->file($key));
                if ($value['status'] !== 200) {
                    return response($value['message'], $value['status']);
                } else {
                    $value = $value['dir'];
                }
            }
            $row = $agency_fields->where('key', $key)->first();
            if ($row) {
                $row->update([
                    'value' => str_replace(',', '', $value)
                ]);
            } else {
                $row = new AgencyInfo();
                $row->key = $key;
                $row->value = str_replace(',', '', $value);
                $row->parent_id = $r->id;
                $row->save();
            }
        }
        return $agency_fields->first();
        // return view('AgencyView::edit')->with([ 'agency_fields' => $agency_fields ]);
    }

    public static function create($parent_id, $key, $value, $des = null)
    {
        AgencyInfo::updateOrCreate(
            [
                'key' => $key,
                'parent_id' => $parent_id,
            ],
            [
                'value' => $value,
                'description' => $des
            ]
        );
    }

    public static function updateById($id, $key, $value, $des = null)
    {
        AgencyInfo::updateOrCreate(
            [
                'key' => $key,
                'id' => $id,
            ],
            [
                'value' => $value,
                'description' => $des
            ]
        );
    }

    public static function createNew($key, $value, $parent_id, $des = null)
    {
        AgencyInfo::create(
            [
                'key' => $key,
                'value' => $value,
                'parent_id' => $parent_id,
                'description' => $des
            ]
        );
    }

    public static function deleteByKey(Request $r)
    {
        $row = GetAgencyController::getByKey($r->parent_id, $r->key);
        $row->delete();
        return $row;
    }

    public static function getAgencyFieldsByParentId($parent_id)
    {
        return AgencyInfo::where('parent_id', $parent_id)->get();
    }
}
