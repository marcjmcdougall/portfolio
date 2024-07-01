<x-base>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <ul class="breadcrumbs">
                    <li class="breadcrumbs__item">
                        <a href="{{ route('articles.index') }}">Articles</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="{{ route('articles.index') }}">Conversion-Rate Optimization</a>
                    </li>
                </ul>
                <h1>{{ $article->title }}</h1>
                <div class="article__content">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </div>
</x-base>