<?php

use App\Http\Controllers\Api\GuildSimulateController;
use App\Http\Controllers\Api\PlayerClassController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\PlayerSessionController;
use App\Http\Controllers\Api\RpgSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('players')->group(function () {
    Route::get('/', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/classes', [PlayerClassController::class, 'index'])->name('players.classes.index');

    Route::post('/', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/{id}', [PlayerController::class, 'show'])->name('players.show');
    Route::put('/{id}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/{id}', [PlayerController::class, 'destroy'])->name('players.destroy');

});

Route::prefix('sessions')->group(function () {
    Route::get('/', [RpgSessionController::class, 'index'])->name('sessions.index');
    Route::get('/{id}', [RpgSessionController::class, 'show'])->name('sessions.show');
    Route::post('/', [RpgSessionController::class, 'store'])->name('sessions.store');
    Route::put('/{id}', [RpgSessionController::class, 'update'])->name('sessions.update');
    Route::delete('/{id}', [RpgSessionController::class, 'destroy'])->name('sessions.destroy');

    Route::post('/{id}/players', [PlayerSessionController::class, 'sessions.associate.players']);

});

// Route::post('/simulate-guilds', [GuildSimulateController::class, 'simulate']); pensado endpoitn para simulação
// Route::post('/simulate-guilds/confirm', [GuildSimulateController::class, 'simulate']); pensado endpoitn para efetivação da simulação de guilda e inicio da sessão
