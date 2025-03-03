<article class="article-excerpt archive__item">
    <a href="{{ route('articles.show', $article->slug) }}">
        <h2 class="h3 article__title">{{ $article->title }}</h2>
        @isset( $article->byline )
            <p class="article__byline">{{ $article->byline }}</p>
        @endisset
        <p class="article__excerpt">{{ $article->excerpt }}</p>
        <p class="article__learn-more">
            Read more
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M3.125 10H16.875" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </p>
    </a>
</article>