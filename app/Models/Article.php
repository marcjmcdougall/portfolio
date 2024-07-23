<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\LazyLoadImageRenderer;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\MarkdownConverter;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected $casts = [
        'topic' => 'array',
    ];

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

    /* 
     * Determines if the user can see the current article (either it is published or they are logged in)
     */
    public function scopeVisible($query)
    {
        return $query->where(function ($query) {
            $query->where('status', 'published');
            if (Auth::check()) {
                $query->orWhere('status', '!=', 'published');
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
