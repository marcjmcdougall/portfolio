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
                            <x-testimonials.excerpt :testimonial="$testimonial" showPhoto></x-testimonials.excerpt>
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
                        <label class="section-label">Testimonial Types</label>
                        <ul class="normalize-list">
                            <li>
                                <a href="#">Consulting</a>
                            </li>
                            <li>
                                <a href="#">Newsletter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
