<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YourController;
use App\Http\Controllers\TestController;


Route::get('/', [YourController::class, 'getHtmlPage']);
Route::post('/', [YourController::class, 'validatePhone']);


Route::get('/api', [TestController::class, 'api']);

