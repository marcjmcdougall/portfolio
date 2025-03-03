<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header 
                    title="Testimonials" 
                    description="Here from my lovely past clients, and others that (somehow) seem to enjoy interacting with me in some capacity.">
                </x-page-header>

                <x-brands-list></x-brands-list>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mobile--bottom">
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
                            {{-- <li>
                                <a href="{{ route('articles/case-studies') }}">Case Studies</a>
                            </li> --}}
                            <li @class([
                                    'active' => 'conversion-rate-optimization' == ($type ?? '')
                                ]) >
                                <a href="{{ route('testimonials.type', ['type' => 'conversion-rate-optimization']) }}">Conversion-Rate Optimization</a>
                            </li>
                            <li @class([
                                    'active' => 'ui-design' == ($type ?? '')
                                ]) >
                                <a href="{{ route('testimonials.type', ['type' => 'ui-design']) }}">UI Design</a>
                            </li>
                            <li @class([
                                    'active' => 'landing-page-design' == ($type ?? '')
                                ])>
                                <a href="{{ route('testimonials.type', ['type' => 'landing-page-design']) }}">Landing Page Design</a>
                            </li>
                            <li @class([
                                    'active' => 'software-development' == ($type ?? '')
                                ]) >
                                <a href="{{ route('testimonials.type', ['type' => 'software-development']) }}">Software Development</a>
                            </li>
                            <li @class([
                                    'active' => 'wordpress-development' == ($type ?? '')
                                ]) >
                                <a href="{{ route('testimonials.type', ['type' => 'wordpress-development']) }}">WordPress Development</a>
                            </li>
                            <li @class([
                                    'active' => 'personal-character' == ($type ?? '')
                                ]) >
                                <a href="{{ route('testimonials.type', ['type' => 'personal-character']) }}">Personal Character</a>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar__item cta cta--secondary">
                        <h2 class="h4 margin-top--strip">Add a review</h3>
                        <p>Visit Google to add your own review (listing as Clarity-First Consulting).</p>
                        <a href="https://g.page/r/CQyABeikKoUgEAE/review" target="blank" class="btn btn--secondary margin-top--xs">Leave A Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
