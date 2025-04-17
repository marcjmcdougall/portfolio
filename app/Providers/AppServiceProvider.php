<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\TestimonialsComposer;
use App\View\Composers\BrandsComposer;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use App\Helpers\LazyLoadImageRenderer;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('NoCaptcha', \Anhskohbo\NoCaptcha\Facades\NoCaptcha::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add testimonials to components that render them.
        View::composer([
            'components.newsletter-opt-in',
            'resources.clarity-call',
        ], TestimonialsComposer::class);
    }
}
