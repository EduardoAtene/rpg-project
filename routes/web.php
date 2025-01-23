<?php

use App\Http\Controllers\PlayerViewController;
use App\Http\Controllers\RpgSessionViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/players', [PlayerViewController::class, 'index']);
Route::get('/players/create', [PlayerViewController::class, 'create']);
Route::get('/players/{id}/edit', [PlayerViewController::class, 'edit']);


Route::get('/sessions', [RpgSessionViewController::class, 'index']);
Route::get('/sessions/create', [RpgSessionViewController::class, 'create']);
Route::get('/sessions/{id}/edit', [RpgSessionViewController::class, 'edit']);
