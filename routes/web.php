<?php

use App\Http\Controllers\ProfileController;
use Behin\SimpleWorkflow\Controllers\Core\CaseController;
use Behin\SimpleWorkflow\Models\Core\Inbox;
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
    $rows = Inbox::where('case_name', '')->get();
    foreach($rows as $row){
        $case = CaseController::getById($row->case_id);
        $fullname = $case->getVariable('fullname');
        if($fullname){
            $nationalId = $case->getVariable('national_id');
            if($nationalId){
                $row->case_name = "$fullname | کدملی: $nationalId";
                $row->save();
            }
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
