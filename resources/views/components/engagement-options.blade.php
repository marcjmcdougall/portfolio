<section class="engagement-options margin-top--lg">
    <div class="row engagement-options__items margin-top--sm">
        <div class="col-6">
            <h2 class="margin-top--strip h3">There's a few things we can do here&hellip;</h2>
            {{-- <h2 class="margin-top--strip">Here's&hellip;</h2> --}}
            <p>I also have a <a href="{{ route('articles.index') }}" class="link--inline">bunch of articles</a> you can read, and have been <a href="{{ route('podcast-appearances.index') }}" class="link--inline">a guest on several podcasts</a>, which are also <em>completely</em> free.</p>
        </div>
        <div class="col-6">
            <div class="articles">
                {{-- <div class="article-excerpt archive__item engagement-option__item">
                    <a href="{{ route('resources.free-course' ) }}">
                        <h2 class="h4 margin-bottom--strip">Design Email Course</h2>
                        <p class="article__byline">Free</p>
                        <p class="article__excerpt">Rather do it yourself?  Learn how to design landing pages that get more people to buy your stuff.</p>
                    </a>
                </div> --}}
                <div class="article-excerpt archive__item engagement-option__item">
                    <a href="{{ route('resources.clarity-call' ) }}">
                        <h2 class="h4 margin-bottom--strip">
                            <span class="engagement-option__title">
                                Clarity Call
                            </span>
                        </h2>
                        <p class="article__byline">$250, one time payment</p>
                        <p class="article__excerpt">We'll uncover <em>exactly</em> why prospects aren't signing up in less than 90-minutes.</p>
                        <p class="engagement-option__learn-more">
                            Learn more
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M3.125 10H16.875" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </p>
                    </a>
                </div>
                <div class="article-excerpt archive__item engagement-option__item">
                    <a href="{{ route('resources.teardown' ) }}">
                        <h2 class="h4 margin-bottom--strip">
                            <span class="engagement-option__title">
                                Landing Page Teardown
                            </span>
                            <div class="right">
                                <span class="badge">New</span>
                            </div>
                        </h2>
                        <p class="article__byline">Pricing varies</p>
                        <p class="article__excerpt">Get tailored conversion improvements for your landing page in less then 48-hours.</p>
                        <p class="engagement-option__learn-more">
                            Learn more
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M3.125 10H16.875" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </p>
                    </a>
                </div>
                <div class="article-excerpt archive__item engagement-option__item" x-data>
                    <h2 class="h4 margin-bottom--strip">Full-Service Consulting</h2>
                    <p class="article__byline">Pricing varies</p>
                    <p class="article__excerpt">Comprehensive analysis, custom landing page design + development, A/B testing, and ongoing optimization.</p>
                    <a href="#" 
                        x-on:click.prevent="
                            Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;"  
                        class="article__button btn btn--secondary">
                            Book Discovery Call
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>