<?php

use App\Http\Controllers\Api\PlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/players', [PlayerController::class, 'index']);
Route::post('/player', [PlayerController::class, 'store']);
Route::get('/player/{id}', [PlayerController::class, 'show']);
Route::put('/player/{id}', [PlayerController::class, 'update']);
Route::delete('/player/{id}', [PlayerController::class, 'destroy']);
