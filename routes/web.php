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




Route::get('/', IndexController::class)->name('index');// invoke если такой был
//Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');// если обычный

Auth::routes();

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([ 'middleware' => 'auth'  ],  function () {
    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
    ], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
        Route::get('/open/{param}', [App\Http\Controllers\HallController::class, 'open'])->name('admin.open');
        Route::any('/createHall', [App\Http\Controllers\HallController::class, 'create'])->name('admin.createHall');
        Route::any('/destroyHall/{id}', [App\Http\Controllers\HallController::class, 'destroy'])->name('admin.destroyHall');
        Route::any('/updateHall', [App\Http\Controllers\HallController::class, 'update'])->name('admin.updateHall');
        Route::any('/editHall', [App\Http\Controllers\HallController::class, 'edit'])->name('admin.editHall');
        Route::any('/editPriceHall', [App\Http\Controllers\HallController::class, 'editPriceHall'])->name('admin.editPriceHall');
          //Route::resource('/hall{id}', [App\Http\Controllers\HallController::class]);
        Route::any('/createFilm', [App\Http\Controllers\FilmController::class, 'create'])->name('admin.createFilm');
        Route::any('/destroyFilm/{id}', [App\Http\Controllers\FilmController::class, 'destroy'])->name('admin.destroyFilm');

        Route::any('/createSeance', [App\Http\Controllers\SeanceController::class, 'create'])->name('admin.createSeance');
    });
});


Route::get('/hall', [App\Http\Controllers\HallController::class, 'show'])->name('client.hall');
Route::get('/ticket', [App\Http\Controllers\TicketController::class, 'index'])->name('client.ticket');
Route::any('/seat', [App\Http\Controllers\SeatController::class, 'edit'])->name('client.seat');
Route::get('/ticket/create', [App\Http\Controllers\TicketController::class, 'create'])->name('client.ticket.create');
















//value="{{ old('name') ?? $product->name ?? '' }}"












/*=================
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



Route::any('/', function () {
    return view('index');
});

================*/


//Route::any('/admin/loginAdmin', [\App\Http\Controllers\LoginAdminController::class, 'index'])->name('loginAdmin');




