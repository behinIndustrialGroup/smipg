<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\Role;

class RoleController extends Controller
{
    public static function get($id){
        return Role::find($id);
    }
    public static function listForm(){
        return view('CSViews::role.list');
    }
    public static function list(){
        return [ 'data' => Role::get() ];
    }
    public static function createForm(){
        return view('CSViews::role.create');
    }
    public static function create(Request $r){
        return Role::create([
            'name' => $r->name
        ]);
    }
    public static function editForm(Request $r){
        return view('CSViews::role.edit')->with([
            'role' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r){
        $role = self::get($r->id);
        $role->name = $r->name;
        $role->save();
        return $role;
    }
}