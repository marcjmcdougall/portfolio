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
        <p class="article__learn-more">
            Watch episode
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M3.125 10H16.875" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </p>
    </a>
</article>
