<?php 

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mkhodroo\CorrespondenceSystem\Models\Sign;

class SignController extends Controller
{
    public static function get($id){
        return Sign::find($id);
    }
    public static function getUserSigns(){
        return Sign::where('user_id', Auth::id())->get();
    }
    public static function listForm(){
        return view('CSViews::sign.list');
    }
    public static function list(){
        return [ 'data' => Sign::get()->each(function($row){
            $row->username = User::find($row->user_id)->name;
        }) ];
    }
    public static function createForm(){
        return view('CSViews::sign.create')->with([
            'users' => User::get()
        ]);
    }
    public static function create(Request $r){
        return Sign::create([
            'user_id' => $r->user_id,
            'name' => $r->name,
            'file' => base64_encode(file_get_contents($r->file('file')->getRealPath()))
        ]);
    }
    public static function editForm(Request $r){
        $sign = self::get($r->id);
        return view('CSViews::sign.edit')->with([
            'username' => User::find($sign->user_id)->name,
            'sign' => $sign
        ]);
    }
    public static function edit(Request $r){
        $row = self::get($r->id);
        $row->name = $r->name;
        $row->file = base64_encode(file_get_contents($r->file('file')->getRealPath()));
        $row->save();
        return $row;
    }
}