<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs">
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
                        <div style="background-image: url( '{{ asset( 'storage/' . $article->featured_image ) }}' )"
                            class="article__thumbnail" ></div>
                    @endisset
                    <div class="article__header">
                        <h1>
                            {{ $article->title }}
                        </h1>
                        @if( $article->byline )
                            <p class="article__byline">{{ $article->byline }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="article__content normalize--content">
                        {!! Illuminate\Support\Str::of($article->content)->markdown() !!}
                    </div>
                </div>

                <div class="col-4">
                    <nav class="table-of-contents">
                        <label class="table-of-contents__header">Table of Contents</label>

                        <ul class="table-of-contents__list normalize-list">
                            <li class="table-of-contents__item table-of-contents__item--active">
                                <a href="#">Introduction</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Start with the low-hanging fruit</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Understand your customer</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Answer pre-sale questions</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Minimize friction</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Consider the customer journey</a>
                            </li>
                            <li class="table-of-contents__item">
                                <a href="#">Takeaways</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </article>
    </div>
</x-base>