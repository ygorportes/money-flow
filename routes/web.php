<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProviderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);
