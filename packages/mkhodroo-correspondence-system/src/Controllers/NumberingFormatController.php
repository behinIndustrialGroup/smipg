<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\NumberingFormat;

class NumberingFormatController extends Controller
{
    public static function get($id){
        return NumberingFormat::find($id);
    }
    public static function listForm(){
        return view('CSViews::numbering-format.list');
    }
    public static function list(){
        return [ 'data' => NumberingFormat::get() ];
    }
    public static function createForm(){
        return view('CSViews::numbering-format.create');
    }
    public static function create(Request $r){
        return NumberingFormat::create($r->except('_token'));
    }
    public static function editForm(Request $r){
        return view('CSViews::numbering-format.edit')->with([
            'format' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r){
        $row = self::get($r->id);
        $row->name = $r->name;
        $row->format = $r->format;
        $row->start_from = $r->start_from;
        $row->save();
        return $row;
    }

    public static function getNewNumber($numbering_format_id){
        
    }
}