<?php

use App\Http\Controllers\AudioStreamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StyleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/styles/{id}", [StyleController::class, "index"]);

Route::post("/games/{game}", [GameController::class, "changeGameStatus"]);

Route::get("/games/current", [GameController::class, "getSelectedGame"]);
