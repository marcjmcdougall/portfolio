<?php

use App\Mail\QuickScanCompleted;
use App\Mail\QuickScanInform;
use App\Models\QuickScan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Testimonial;
use App\Models\PodcastAppearance;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\QuickScanReportController;
use App\Http\Controllers\ToolsController;

// Individual Pages
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/start', function () {
    return view('start');
})
    ->middleware('transform.video.params') // Transforms ?v={VIDEO_ID} into standard UTM params.
    ->name('start');

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
    Route::get('/teardown', [ResourceController::class, 'teardown'])
        ->name('resources.teardown');
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

// Quick Scans
Route::get('/resources/quick-scan', [QuickScanReportController::class, 'create'])
    ->name('quick-scan.create');

Route::post('/resources/quick-scan', [QuickScanReportController::class, 'store'])
    ->name('quick-scan.store');

Route::get('/resources/quick-scan/report/{domain}/{quickScan}', [QuickScanReportController::class, 'show'])
    ->name('quick-scan.show')
    ->where('domain', '.*'); // This allows the URL to contain slashes and other characters

// Redirects
Route::get('/learn', function () {
    return redirect()->route('resources.free-course');
});

Route::get('/clarity-call', function () {
    return redirect()->route('resources.clarity-call');
});

Route::get('/teardown', function () {
    return redirect()->route('resources.teardown');
});

Route::get('/quick-scan', function () {
    return redirect()->route('quick-scan.create');
});

Route::get('/scan', function () {
    return redirect()->route('quick-scan.create');
});

Route::prefix('tools')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/calculator', [ToolsController::class, 'calculator'])->name('tools.calculator');
    });
    
// 404 Page
Route::fallback(function () {
    return view('404');
});

// Route::get('/debug-mail', function () {
//     $quickScan = QuickScan::where('id', 21)->first();
//     return new QuickScanCompleted($quickScan)->render();
// });
