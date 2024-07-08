<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header 
                    title="Podcast Appearances" 
                    description="Here from my lovely past clients, and others that (somehow) seem to enjoy interacting with me in some capacity.">
                </x-page-header>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="archive">
                    <label class="section-label">Most Recent</label>
                    <div class="archive-wrapper">
                        @forelse ($podcast_appearances as $podcast_appearance)
                            <x-podcast-appearances.excerpt :podcast-appearance="$podcast_appearance"></x-podcast-appearances.excerpt>
                        @empty
                            <p>No appearances!</p>
                        @endforelse

                        {{-- {{ $testimonials->links('pagination.default') }} --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="sidebar">
                    <div class="sidebar__item topics">
                        <label class="section-label">Topics</label>
                        <ul class="normalize-list">
                            <li>
                                <a href="#">Popular</a>
                            </li>
                            <li>
                                <a href="#">Conversion-Rate Optimization</a>
                            </li>
                            <li>
                                <a href="#">UI Design</a>
                            </li>
                            <li>
                                <a href="#">Consulting</a>
                            </li>
                            <li>
                                <a href="#">Marketing</a>
                            </li>
                            <li>
                                <a href="#">Business</a>
                            </li>
                            <li>
                                <a href="#">Freelancing</a>
                            </li>
                            <li>
                                <a href="#">Landing Pages</a>
                            </li>
                            <li>
                                <a href="#">Software Development</a>
                            </li>
                            <li>
                                <a href="#">WordPress</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>