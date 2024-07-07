<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header 
                    title="Testimonials" 
                    description="Here from my lovely past clients, and others that (somehow) seem to enjoy interacting with me in some capacity.">
                </x-page-header>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="archive">
                    <label class="section-label">Most Recent</label>
                    <div class="archive-wrapper">
                        @forelse ($testimonials as $testimonial)
                            <x-testimonials.excerpt :testimonial="$testimonial" showPhoto showRole></x-testimonials.excerpt>
                        @empty
                            <p>No testimonials!</p>
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
                                <a href="#">Conversion-Rate Optimization</a>
                            </li>
                            <li>
                                <a href="#">UI Design</a>
                            </li>
                            <li>
                                <a href="#">Landing Page Design</a>
                            </li>
                            <li>
                                <a href="#">Software Development</a>
                            </li>
                            <li>
                                <a href="#">WordPress Development</a>
                            </li>
                            <li>
                                <a href="#">Personal Character</a>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar__item cta cta--secondary">
                        <h2 class="h4 margin-top--strip">Want to leave your own review?</h3>
                        <p>You can do so over on my Google Business Listing.</p>
                        <a href="https://g.page/r/CQyABeikKoUgEAE/review" target="blank" class="btn btn--tertiary link--external margin-top--xs">Leave A Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
