<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\HallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




















// ** Public routes ** //
//Route::get('/film', [FilmController::class, 'index']);


//Route::any('/film', function () {
  //  return redirect('/')->with('status', 'Profile updated!');
//});



/*
Route::get('/halls', [HallController::class, 'index']);
Route::get('/seances', [\App\Http\Controllers\SeanceController::class, 'index']);
Route::get('/tickets/{seance}/{date}', [\App\Http\Controllers\TicketController::class, 'show']);
Route::post('/tickets', [\App\Http\Controllers\TicketController::class, 'store']);

Route::get('seance', [\App\Http\Controllers\SeanceController::class, 'seances'])->name('seance');

//Route::middleware('auth:sanctum')->get('/user', function () {
Route::post('halls', [HallController::class, 'store']);
Route::put('halls/{id}', [HallController::class, 'update']);
Route::delete('halls/{id}', [HallController::class, 'destroy']);
*/

//https://maxyc.ru/programming/laravel/restful-api-laravel/ crud
