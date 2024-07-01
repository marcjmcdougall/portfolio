<x-base>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <a href="{{ route('articles.index') }}">Back to All Articles</a>
                <h1>{{ $article->title }}</h1>
                <div class="article__content">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </div>
</x-base>