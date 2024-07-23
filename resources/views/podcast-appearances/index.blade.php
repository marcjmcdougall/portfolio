<x-base>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header 
                    title="Podcast Appearances" 
                    description="I've been known to ramble about all things design and marketing on a podcast or two.  Check them out for some free tips & tricks.">
                </x-page-header>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mobile--bottom">
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
                            {{-- <li>
                                <a href="{{ route('articles/case-studies') }}">Case Studies</a>
                            </li> --}}
                            <li @class([
                                    'active' => 'popular' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'popular']) }}">Popular</a>
                            </li>
                            <li @class([
                                    'active' => 'conversion-rate-optimization' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'conversion-rate-optimization']) }}">Conversion-Rate Optimization</a>
                            </li>
                            {{-- <li @class([
                                    'active' => 'ui-design' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'ui-design']) }}">UI Design</a>
                            </li> --}}
                            <li @class([
                                    'active' => 'consulting' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'consulting']) }}">Consulting</a>
                            </li>
                            <li @class([
                                    'active' => 'marketing' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'marketing']) }}">Marketing</a>
                            </li>
                            <li @class([
                                    'active' => 'business' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'business']) }}">Business</a>
                            </li>
                            <li @class([
                                    'active' => 'freelancing' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'freelancing']) }}">Freelancing</a>
                            </li>
                            <li @class([
                                    'active' => 'landing-pages' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'landing-pages']) }}">Landing Pages</a>
                            </li>
                            <li @class([
                                    'active' => 'software-development' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'software-development']) }}">Software Development</a>
                            </li>
                            {{-- <li @class([
                                    'active' => 'wordpress' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('podcast-appearances.topic', ['topic' => 'wordpress']) }}">WordPress</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
