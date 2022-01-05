<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function() {
    Route::get('user/datatable', [UserController::class, 'datatable'])->name('user.datatable');
    Route::resource('user', UserController::class);

    Route::get('jadwal/datatable', [JadwalController::class, 'datatable'])->name('jadwal.datatable');
    Route::resource('jadwal', JadwalController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
