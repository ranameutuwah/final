<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\SewaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengarangController;
use App\Http\Controllers\Admin\PinjamController;


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

Route::get('/', function () {
    return view('auth.login');
});

//grup Route Untuk admin
Route::prefix('admin')->group(function () {
    // Route untuk auth
    Route::group(['middleware' => 'auth'], function () {
        //Buat route untuk Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        //Buat route untuk Data Buku
        Route::resource('/buku', BukuController::class, ['as' => 'admin']);

        Route::resource('/pengarang', PengarangController::class, ['as' => 'admin']);

        Route::resource('/sewa', SewaController::class, ['as' => 'admin']);

    });
});
