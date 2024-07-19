<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\LazyLoadImageRenderer;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\MarkdownConverter;

class Article extends Model
{
    use HasFactory;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($article) {
            if (auth()->check()) {
                $article->user_id = auth()->id();
            }
        });
    }

    public function renderContentMarkdown() {
        // \Log::info('Initializing Markdown conversion.');

        // Create the environment
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(Image::class, new LazyLoadImageRenderer());

        // \Log::info('Environment configured with LazyLoadImageRenderer.');

        // Create the converter using the environment
        $converter = new MarkdownConverter($environment);

        // \Log::info('Markdown converter initialized.');

        // $markdownContent = '![Alt text](http://example.com/image.jpg)';
        $result = $converter->convert($this->content);

        // \Log::info('Markdown conversion completed.');

        return $result->getContent();
    }
}
