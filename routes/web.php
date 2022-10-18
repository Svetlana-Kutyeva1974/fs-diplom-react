<?php

use Illuminate\Support\Facades\Auth;
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

Route::any('/', function () {
    return view('welcome');
});

Route::group([ 'middleware' => 'admin'  ],  function () {
    Route::any('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    //->name('admin');дали название роуту
});

Route::any('/admin/loginAdmin', [\App\Http\Controllers\LoginAdminController::class, 'index'])->name('loginAdmin');


Auth::routes();

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::group([ 'middleware' => 'auth'  ],  function () {
    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
    ], function () {
        Route::get('/', function () {
            return view('admin.admin', ['user' => Auth::user()]);
        });
   });
});
*/
