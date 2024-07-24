<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="{{ route('articles.index') }}">Articles</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="{{ route('articles.index') }}">Conversion-Rate Optimization</a>
                    </li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="row">
                <div class="col-12">
                    @isset($article->featured_image)
                        <div class="lazy-wrapper">
                            <div class="article__thumbnail lazy-bg" data-bg="{{ asset( 'storage/' . $article->featured_image ) }}" >
                                <img class="sr-only" alt="Featured image for this article" />
                            </div>
                        </div>
                    @endisset
                    <div class="article__header">
                        <h1 class="h2">
                            {{ $article->title }}
                        </h1>
                        @if( $article->byline )
                            <p class="article__byline">{{ $article->byline }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mobile--bottom">
                    <div class="article__content normalize--content">
                        {{-- {!! Illuminate\Support\Str::of($article->content)->markdown() !!} --}}

                        {!! $article->renderContentMarkdown() !!}
                    </div>
                </div>

                @isset($article->table_of_contents) 
                    <div class="col-4">
                        <nav class="table-of-contents">
                            <label class="table-of-contents__header section-label">Table of Contents</label>

                            <ul class="table-of-contents__list normalize-list">
                                <li class="table-of-contents__item table-of-contents__item--active">
                                    <a href="#">Introduction</a>
                                </li>
                                @forelse ($article->table_of_contents as $table_of_contents_item_url => $table_of_contents_item_label)
                                    <li class="table-of-contents__item">
                                        <a href="{{ $table_of_contents_item_url }}">{{ $table_of_contents_item_label }}</a>
                                    </li>
                                @empty
                                    No table of contents data found.
                                @endforelse
                            </ul>
                        </nav>
                    </div>
                @endisset
            </div>
        </article>
    </div>
</x-base>