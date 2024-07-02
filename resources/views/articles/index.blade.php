<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header title="Articles" description="Learn about our product updates, company news, technical pieces, and tutorials. Want to subscribe? Grab our RSS feed or signup to get this content in your inbox (once a month).">
                    <form class="form form--inline form--stretch-inputs">
                        <x-input.base name="FNAME" label="First name" width="215" hide-label>
                            <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                        </x-input.base>

                        <x-input.base name="EMAIL" label="Email" hide-label>
                            <x-input.text-input name="EMAIL" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                        </x-input.base>

                        <input type="submit" value="Subscribe" class="btn btn--secondary" />
                    </form>
                </x-page-header>

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
