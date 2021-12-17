<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\GameLogicController;
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
    return view('welcome');
});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::resource('games', GameController::class);
Route::resource('slots', SlotController::class);
Route::resource('scoreboard', ScoreboardController::class);
Route::post('games/{game}/guess', [GameLogicController::class, 'guess']);