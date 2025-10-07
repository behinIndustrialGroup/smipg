<?php

use App\Http\Controllers\ProfileController;
use Behin\SimpleWorkflow\Controllers\Core\CaseController;
use Behin\SimpleWorkflow\Controllers\Core\InboxController;
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
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate');
});

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test', function () {
    $rows = Inbox::where('task_id', '255001b9-162c-4474-9b7d-b58bd2c1832c')->where('status','new')->get();
    foreach($rows as $row){
        Inbox::create([
            'task_id'=> '255001b9-162c-4474-9b7d-b58bd2c1832c',
            'case_id' => $row->case_id,
            'case_name' => $row->case_name,
            'status' => 'new',
            'actor' => 10
        ]);
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
