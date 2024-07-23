<article class="article-excerpt archive__item">
    <a href="{{ route('articles.show', $article->slug) }}">
        <h2 class="h3 article__title">{{ $article->title }}</h2>
        @isset( $article->byline )
            <p class="article__byline">{{ $article->byline }}</p>
        @endisset
        <p class="article__excerpt">{{ $article->excerpt }}</p>
        {{-- <p class="article__link">Read more</p> --}}
    </a>
</article>