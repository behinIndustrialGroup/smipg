<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\TemplateAccess;

class TemplateAccessController extends Controller
{
    public static function get($id){
        return TemplateAccess::find($id);
    }
    public static function listForm(){
        return view('CSViews::template-access.list');
    }
    public static function list(){
        return [ 'data' => TemplateAccess::get()->each(function($row){
            $row->template = TemplateController::get($row->template_id)->name;
            $row->role_id = RoleController::get($row->role_id)->name;
        }) ];
    }
    public static function createForm(){
        return view('CSViews::template-access.create')->with([
            'templates' => TemplateController::list()['data'],
            'roles' => RoleController::list()['data']
        ]);
    }
    public static function create(Request $r){
        return TemplateAccess::create([
            'template_id' => $r->template_id,
            'role_id' => $r->role_id,
            'create' => $r->create ? 1 : 0,
            'numbering' => $r->numbering ? 1 : 0,
            'signing' => $r->signing ? 1 : 0,
        ]);
    }
    public static function editForm(Request $r){
        return view('CSViews::template-access.edit')->with([
            'templates' => TemplateController::list()['data'],
            'roles' => RoleController::list()['data'],
            'access' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r){
        $row = self::get($r->id);
        $row->template_id = $r->template_id;
        $row->role_id = $r->role_id;
        $row->create = $r->create ? 1 : 0;
        $row->numbering = $r->numbering ? 1 : 0;
        $row->signing = $r->signing ? 1 : 0;
        $row->save();
        return $row;
    }
}