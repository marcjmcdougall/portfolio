<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('index');
});

// Articles
Route::resource('articles', ArticleController::class);
