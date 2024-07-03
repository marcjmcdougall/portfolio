<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Testimonial;
use App\Http\Controllers\ResourceController;

Route::get('/', function () {
    return view('index');
})->name('index');

// Articles
Route::resource('articles', ArticleController::class);

// Testimonials
Route::get('/testimonials', function () {
    $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
    return view('testimonials.index', compact('testimonials'));
})->name('testimonials.index');

// Resources
Route::prefix('resources')->group(function () {
    Route::get('/', [ResourceController::class, 'index'])
        ->name('resources.index');
    Route::get('/clarity-call', [ResourceController::class, 'clarityCall'])
        ->name('resources.clarity-call');
    Route::get('/free-course', [ResourceController::class, 'freeCourse'])
        ->name('resources.free-course');
});

// Redirects
Route::get('/learn', function () {
    return redirect()->route('resources.free-course');
});
