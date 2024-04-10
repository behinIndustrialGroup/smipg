<?php 

namespace Mkhodroo\Nerkhnameh\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\MkhodrooProcessMaker\Models\PMCase;
use SoapClient;


class RegisterController extends Controller{
    public function registerForm(){
        return view('NerkhnamehView::register');
    }
}


