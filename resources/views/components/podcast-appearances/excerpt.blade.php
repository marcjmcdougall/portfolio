<article class="podcast-appearance">
    <a href="{{ $podcastAppearance->link }}" target="_blank" rel="noopener">
        <div class="podcast-appearance__title-wrapper">
            <div class="podcast-appearance__text">
                <h3 class="podcast-appearance__header margin-top--strip margin-bottom--strip">{{ $podcastAppearance->episode_title }}</h3>
                <p class="podcast-appearance__podcast-name">{{ $podcastAppearance->podcast_name }}</p>
            </div>
            @if( $podcastAppearance->featured_image )
                <div class="podcast-appearance__featured-image lazy-bg"
                    data-bg="{{ asset( 'storage/' . $podcastAppearance->featured_image ) }}" >
                    <img class="sr-only" alt="Podcast image for the {{ $podcastAppearance->podcast_name }} podcast" />
                </div>
            @endif
        </div>
        
        <p class="podcast-appearance__excerpt margin-bottom--strip">{{ $podcastAppearance->excerpt }}</p>
    </a>
</article>
