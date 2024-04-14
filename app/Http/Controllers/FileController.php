<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public static function store($file, $dir = 'docs', array $type = []){
        if(empty($type)){
            $type = config('app.valid_upload_file_type');
        }
        if(!in_array($file->getMimeType(), $type)){
            return [
                'status' => 400,
                'message' => trans("File Format Is Invalid")
            ];
        }
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $full_path = public_path($dir);
        Log::info($full_path);
        if ( !is_dir($full_path)) {
            mkdir($full_path);
        }
        $full_name = $full_path . '/' . $name;
        $result = move_uploaded_file($file,$full_name);
        if($result){
            return [
                'status' => 200,
                'message' => trans("File Uploaded"),
                'dir' => 'public/' . $dir . '/' . $name
            ];
        }
        return [
            'status' => 500,
            'message' => trans("Error In Uploading File")
        ];
    }
}
