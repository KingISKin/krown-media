<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Upload de imagens
|--------------------------------------------------------------------------
*/

Route::post('/upload-image', [ImageController::class, 'upload']);