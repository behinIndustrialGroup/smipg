<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/migrate', function () {
    Artisan::call('config:clear');
    Artisan::call('migrate');
});

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test', function () {
    $rows = file_get_contents(base_path('/packages/mkhodroo-agency-info/src/Lang/fa.json'));
    $rows = json_decode($rows);
    foreach($rows as $key => $value){
        
        $tr = DB::table('ltm_translations')->where('key', $key)->first();
        if($tr){
            DB::table('ltm_translations')->where('key', $key)->update(['value' => $value]);
        }else{
            DB::table('ltm_translations')->insert([
                'status' => 0,
                'locale' => 'fa',
                'group' => 'key',
                'key' => $key,
                'value' => $value
            ]);
        }
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','access'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
