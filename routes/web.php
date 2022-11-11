<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
/*
Route::any('/', function () {
    return view('index');
});
*/



Route::get('/', IndexController::class)->name('index');// invoke если такой был
//Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');


/*
Route::group([
    'middleware' => 'guest',
], function($dateCurrent, $dateChosen, &$films, &$halls, &$seances ){
  return view('index',['films' => $films, 'halls' => $halls, 'seances'=> $seances, 'dateCurrent' => $dateCurrent, 'dateChosen'=> $dateChosen]);
});
*/

//Route::get('/film', FilmController::class, 'index');

/*
Route::group([ 'middleware' => 'admin'  ],  function () {
    Route::any('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    //->name('admin');дали название роуту
});
*/
//Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('auth');;
// Админка
/*Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function()
{
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
});
*/


Route::any('/admin/loginAdmin', [\App\Http\Controllers\LoginAdminController::class, 'index'])->name('loginAdmin');


Auth::routes();

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([ 'middleware' => 'auth'  ],  function () {
    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
    ], function () {
        Route::get('/', function () {
            return view('admin.home', ['user' => Auth::user()]);
        })->name('admin.home');
   });
});


/*Route::get('/hall', function () {
    return view('components.client.hall', );
})->name('hall');
*/
Route::get('/hall', [App\Http\Controllers\SeatController::class, 'index'])->name('hall');
Route::get('/ticket', [App\Http\Controllers\TicketController::class, 'index'])->name('ticket');
Route::get('/ticket/{id}', [App\Http\Controllers\TicketController::class, 'index'])->name('create');


/*
Route::get('/hall/{nameHall}/{seance}', function ($nameHall, $seance ) {
    return view('components.client.hall', ['nameHall' => $nameHall, 'seance'=> $seance->id]);
})->name('hall');
*/
