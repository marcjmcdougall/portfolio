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
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;

class Article extends Model
{
    use HasFactory;

    protected $casts = [
        'topic' => 'array',
        'table_of_contents' => 'collection',
    ];

    protected $fillable = [
        'table_of_contents',
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
        $config = [
            'heading_permalink' => [
                'html_class' => 'heading-permalink',
                'id_prefix' => 'heading',
                'apply_id_to_heading' => true,
                'heading_class' => '',
                'fragment_prefix' => 'heading',
                'insert' => 'before',
                'min_heading_level' => 1,
                'max_heading_level' => 6,
                'title' => 'Permalink',
                'symbol' => '#',
                'aria_hidden' => true,
            ],
        ];
        
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(Image::class, new LazyLoadImageRenderer());
        $environment->addExtension(new HeadingPermalinkExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);

        // $markdownContent = '![Alt text](http://example.com/image.jpg)';
        $result = $converter->convert($this->content);

        // \Log::info('Markdown conversion completed.');

        return $result->getContent();
    }
}
