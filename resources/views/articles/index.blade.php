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
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="archive">
                    <label class="section-label">Most Recent</label>
                    <div class="archive-wrapper">
                        @forelse ($articles as $article)
                            <x-articles.excerpt :article="$article"></x-articles.excerpt>
                        @empty
                            <p>No articles!</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="sidebar">
                    <div class="sidebar__item topics">
                        <label class="section-label">Topics</label>
                        <ul class="normalize-list">
                            <li>
                                <a href="#">Case Studies</a>
                            </li>
                            <li>
                                <a href="#">User Experience</a>
                            </li>
                            <li>
                                <a href="#">User Interface</a>
                            </li>
                            <li>
                                <a href="#">Business</a>
                            </li>
                            <li>
                                <a href="#">Marketing</a>
                            </li>
                            <li>
                                <a href="#">Software Design</a>
                            </li>
                            <li>
                                <a href="#">Conversion-Rate Optimization</a>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar__item popular">
                        <label class="section-label">Popular Articles</label>
                        <ul class="normalize-list">
                            <li>
                                <a href="#">The Ultimate Guide to Conversion Rate Optimization</a>
                            </li>
                            <li>
                                <a href="#">How We Doubled Conversions for a SaaS Product in 3 Months</a>
                            </li>
                            <li>
                                <a href="#">Top 5 CRO Mistakes Software Companies Make (And How to Avoid Them)</a>
                            </li>
                            <li>
                                <a href="#">How I get users to sign up for a software demo</a>
                            </li>
                            <li>
                                <a href="#">How to Create Compelling CTAs that Boost Software Conversions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
