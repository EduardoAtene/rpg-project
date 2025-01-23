<?php

use App\Http\Controllers\PlayerViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/players', [PlayerViewController::class, 'index']);
Route::get('/players/create', [PlayerViewController::class, 'create']);
Route::get('/players/{id}/edit', [PlayerViewController::class, 'edit']);
