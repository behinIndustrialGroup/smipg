<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Mkhodroo\CorrespondenceSystem\Models\UserRole;

class UserRoleController extends Controller
{
    public static function get($id){
        return UserRole::find($id);
    }
    public static function listForm(){
        return view('CSViews::user-role.list');
    }
    public static function list(){
        return [ 'data' => UserRole::get()->each(function($row){
            $row->user = User::find($row->user_id)->name;
            $row->role = RoleController::get($row->role_id)->name;
        }) ];
    }
    public static function createForm(){
        return view('CSViews::user-role.create')->with([
            'users' => User::get(),
            'roles' => RoleController::list()['data']
        ]);
    }
    public static function create(Request $r){
        return UserRole::create($r->except('_token'));
    }
    public static function editForm(Request $r){
        return view('CSViews::user-role.edit')->with([
            'users' => User::get(),
            'roles' => RoleController::list()['data'],
            'user_role' => self::get($r->id)
        ]);
    }
    public static function edit(Request $r){
        $role = self::get($r->id);
        $role->user_id = $r->user_id;
        $role->role_id = $r->role_id;
        $role->save();
        return $role;
    }
}