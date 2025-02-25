<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Testimonial;
use App\Models\PodcastAppearance;
use App\Http\Controllers\ResourceController;

// Individual Pages
Route::get('/', function () {
    return view('index');
})->name('index');

// Single Article (by slug)
Route::get('/articles/{slug}', [ArticleController::class, 'showBySlug'])
    ->name('articles.show');

// Article Topic Archive
Route::get('articles/topic/{topic}', [ArticleController::class, 'showByTopic'])
    ->name('articles.topic');

// All other article routes.
Route::resource('articles', ArticleController::class);

// Testimonial Type Archive
Route::get('testimonials/type/{type}', function( $type ) {
    $testimonials = Testimonial::whereJsonContains('type', $type)->paginate(10);
    return view('testimonials.index', compact('testimonials', 'type'));
})
->name('testimonials.type');

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
        Route::get('/functional', [ResourceController::class, 'functional'])
        ->name('resources.functional');
    Route::get('/free-course', [ResourceController::class, 'freeCourse'])
        ->name('resources.free-course');
});

// Podcast Appearance Topic Archive
Route::get('podcast-appearances/topic/{topic}', function( $topic ) {
    $podcast_appearances = PodcastAppearance::whereJsonContains('topic', $topic)->paginate(10);
    return view('podcast-appearances.index', compact('podcast_appearances', 'topic'));
})
->name('podcast-appearances.topic');

// Podcast Appearances
Route::get('/podcast-appearances', function () {
    $podcast_appearances = PodcastAppearance::orderBy('created_at', 'desc')->get();
    return view('podcast-appearances.index', compact('podcast_appearances'));
})->name('podcast-appearances.index');

// Redirects
Route::get('/learn', function () {
    return redirect()->route('resources.free-course');
});

Route::get('/clarity-call', function () {
    return redirect()->route('resources.clarity-call');
});

// 404 Page
Route::fallback(function () {
    return view('404');
});
