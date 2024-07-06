<div class="articles">
    @foreach ($articles as $article)
        <x-articles.excerpt :article="$article"></x-articles.excerpt>
    @endforeach
</div>
