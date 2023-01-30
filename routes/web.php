<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
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

Route::get('/', [HomeController::class,'index']);
Route::get('administrator',function (){
    return redirect('/administrator/dashboard');
});
Route::prefix('/administrator/dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::resource('sponsor', SponsorController::class);
});

require __DIR__ . '/auth.php';
