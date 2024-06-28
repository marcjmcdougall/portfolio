<x-base>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Articles</h1>

                @forelse ($articles as $article)
                    <article class="article-excerpt">
                        <a href="{{ route('articles.show', $article ) }}">
                            <h2 class="h3">{{ $article->title }}</h2>
                            <p>{{ $article->excerpt }}</p>
                        </a>
                    </article>
                @empty
                    <p>No articles!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-base>
