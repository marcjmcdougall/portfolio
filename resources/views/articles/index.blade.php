<x-base
    title="Marc McDougall – Articles on software landing page design"
    description="Browse articles relating to software landing page design and conversion-rate optimization"
    ogTitle="Articles on software landing page design"
    ogDescription="Browse articles relating to software landing page design and conversion-rate optimization" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-page-header
                    title="Articles" 
                    description="Articles about design, software product development, marketing, and conversion-rate optimization.  Subscribe below to be the first to know about new articles. 👇">
                    <form class="form form--inline form--stretch-inputs" method="post" action="https://app.convertkit.com/forms/6861643/subscriptions">
                        <x-input.base name="FNAME" label="First name" width="215" hide-label>
                            <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                        </x-input.base>

                        <x-input.base name="EMAIL" label="Email" hide-label>
                            <x-input.text-input name="EMAIL" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                        </x-input.base>

                        <input type="submit" value="Subscribe" class="btn btn--secondary" />
                    </form>
                </x-page-header>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mobile--bottom">
                <div class="archive">
                    <label class="section-label">Most Recent</label>
                    <div class="archive-wrapper">
                        @forelse ($articles as $article)
                            <x-articles.excerpt :article="$article"></x-articles.excerpt>
                        @empty
                            <p>No articles!</p>
                        @endforelse
                    </div>
                    @if ($articles->hasPages())
                        {{ $articles->links('pagination.default') }}
                    @endif
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
                                    'active' => 'conversion-rate-optimization' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('articles.topic', ['topic' => 'conversion-rate-optimization']) }}">Conversion-Rate Optimization</a>
                            </li>
                            <li @class([
                                    'active' => 'ux' == ($topic ?? '')
                                ])>
                                <a href="{{ route('articles.topic', ['topic' => 'ux']) }}">User Experience</a>
                            </li>
                            <li @class([
                                    'active' => 'ui' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('articles.topic', ['topic' => 'ui']) }}">User Interface</a>
                            </li>
                            <li @class([
                                    'active' => 'business' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('articles.topic', ['topic' => 'business']) }}">Business</a>
                            </li>
                            <li @class([
                                    'active' => 'marketing' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('articles.topic', ['topic' => 'marketing']) }}">Marketing</a>
                            </li>
                            <li @class([
                                    'active' => 'software-design' == ($topic ?? '')
                                ]) >
                                <a href="{{ route('articles.topic', ['topic' => 'software-design']) }}">Software Design</a>
                            </li>
                        </ul>
                    </div>
                    @isset ($popularArticles)
                        <div class="sidebar__item popular">
                            <label class="section-label">Popular Articles</label>
                            <ul class="normalize-list">
                                @forelse ($popularArticles as $popularArticle)
                                    <li>
                                        <a href="{{ route('articles.show', $popularArticle->slug) }}">{{ $popularArticle->title }}</a>
                                    </li>
                                @empty
                                    <li>No popular articles!</li>
                                @endforelse
                                
                            </ul>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-base>
