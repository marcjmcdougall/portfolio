<x-base
    hideNewsletter
    hideNav >
    <div class="container">
        <section id="start-hero" 
            class="row">
            <div class="col-8">
                <h1 class="text--hero strip--mt">How I can help you with design</h1>
                <p class="body--large">There's quite a few ways I can help you with design.  So, I made this page to capture everything in one clean directory.</p>
            </div>
        </section>

        <div class="resource-option-group margin-top--md margin-bottom--lg">
            {{-- Full-service consulting --}}
            <div class="resource-option resource-option--emphasized rounded row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                        alt="An image of the Figma, WordPress, Framer, and Adobe xD logos, showcasing Marc's breadth of expertise."
                        data-src="{{ asset('img/services/consulting.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h2 class="h3 strip--mt margin-bottom--strip">Full service consulting</h2>
                    <p class="article__byline">Pricing varies</p>
                    <p class="">Comprehensive analysis, custom UI design + development, A/B testing, and ongoing optimization.</p>
                    <div class="resource-option__actions" x-data>
                        <div class="glimmer-container glimmer-container--light">
                            <span class="blob"></span>
                            <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary">
                                    Book Discovery Call
                                    <span class="keybind">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M9.84375 2.625C10.2499 2.625 10.6393 2.78633 10.9265 3.07349C11.2137 3.36066 11.375 3.75014 11.375 4.15625C11.375 4.56236 11.2137 4.95184 10.9265 5.23901C10.6393 5.52617 10.2499 5.6875 9.84375 5.6875H8.3125V4.15625C8.3125 3.75014 8.47383 3.36066 8.76099 3.07349C9.04816 2.78633 9.43764 2.625 9.84375 2.625Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.6875 5.6875H4.15625C3.75014 5.6875 3.36066 5.52617 3.07349 5.23901C2.78633 4.95184 2.625 4.56236 2.625 4.15625C2.625 3.75014 2.78633 3.36066 3.07349 3.07349C3.36066 2.78633 3.75014 2.625 4.15625 2.625C4.56236 2.625 4.95184 2.78633 5.23901 3.07349C5.52617 3.36066 5.6875 3.75014 5.6875 4.15625V5.6875Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.3125 8.3125H9.84375C10.2499 8.3125 10.6393 8.47383 10.9265 8.76099C11.2137 9.04816 11.375 9.43764 11.375 9.84375C11.375 10.2499 11.2137 10.6393 10.9265 10.9265C10.6393 11.2137 10.2499 11.375 9.84375 11.375C9.43764 11.375 9.04816 11.2137 8.76099 10.9265C8.47383 10.6393 8.3125 10.2499 8.3125 9.84375V8.3125Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4.15625 11.375C3.75014 11.375 3.36066 11.2137 3.07349 10.9265C2.78633 10.6393 2.625 10.2499 2.625 9.84375C2.625 9.43764 2.78633 9.04816 3.07349 8.76099C3.36066 8.47383 3.75014 8.3125 4.15625 8.3125H5.6875V9.84375C5.6875 10.2499 5.52617 10.6393 5.23901 10.9265C4.95184 11.2137 4.56236 11.375 4.15625 11.375Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.3125 5.6875H5.6875V8.3125H8.3125V5.6875Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        K
                                    </span>
                            </a>
                        </div>
                    </div>
                    <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">Limited availability. 100% corny joke guarantee.</p>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div> 
            <x-brands-list animated></x-brands-list>
        </div>

        <div class="resource-option-group">
            <h2 class="h3 margin-bottom--sm">Paid products & coaching</h2>

            {{-- Functional --}}
            {{-- <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="A profile photo of Marc McDougall, a Scottish man smiling, with a short beard"
                            data-src="{{ asset('img/services/functional.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Functional Design System</h2>
                    <p class="article__byline">Starts at $97</p>
                    <p class="">Comprehensive analysis, custom UI design + development, A/B testing, and ongoing optimization.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary btn--disabled" disabled >Get Functional</a>
                    </div>
                    <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">Available starting late Oct 2025</p>
                </div>
            </div> --}}

            {{-- Clarity Call --}}
            <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts two logos: one for Figma and one for Google Meet, indicating that the Clarity call is a collaborative session in Figma, on a video call."
                            data-src="{{ asset('img/services/clarity-call.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Clarity Call</h2>
                    <p class="article__byline">$250, one-time</p>
                    <p class="">One call with an expert UI designer could save you *months* of spinning your wheels.  Great for beginners, or solo founders.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="{{ route('resources.clarity-call') }}">Learn More</a>
                    </div>  
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

            {{-- Page Teardown --}}
            <div class="resource-option resource-option--last row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts a specific 'hit list' of high-impact changes that should be made to improve a design."
                            data-src="{{ asset('img/services/teardown.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Page Teardown</h2>
                    <p class="article__byline">Starts at $495</p>
                    <p class="">I'll audit your interface and show you *exactly* why your design isn't performing as you expect.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="{{ route('resources.teardown') }}">Learn More</a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

        </div>

        <div class="resource-option-group">
            <h2 class="h3 margin-bottom--sm">Free resources</h2>

            {{-- CRO Quickscan --}}
            <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts a list of improvements that could be made to improve a landing pages' chances of converting new customers."
                            data-src="{{ asset('img/services/quick-scan.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Automatic Site Scanner</h2>
                    <p class="article__byline">Free</p>
                    <p class="">Scan any landing page for hidden conversion-rate optimization opportunuties.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="/" target="_blank">Learn More</a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

            {{-- Design Course --}}
            <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts an email inbox with several highly-valuable design lessons."
                            data-src="{{ asset('img/services/design-course.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">10-Day Design Course</h2>
                    <p class="article__byline">Free</p>
                    <p class="">A 10-day email course that'll teach you how to design landing pages that will help you sell more stuff.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="{{ route('resources.free-course') }}">Learn More</a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

            {{-- Demystifying Design --}}
            <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="The channel logo for the Demystifying Design YouTube channel"
                            data-src="{{ asset('img/services/dd-logo.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Demystifying Design</h2>
                    <p class="article__byline">Free</p>
                    <p class="">Every week, I redesign a popular user interface LIVE on my YouTube channel.  Come check it out, or troll me in the comments.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="https://www.youtube.com/@DemystifyingDesign" target="_blank">
                            Watch On YouTube
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g opacity="0.6">
                                    <path d="M4.5 13.5L13.5 4.5" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.1875 4.5H13.5V11.8125" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

            {{-- Articles --}}
            <div class="resource-option row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts an abstract article about design, indicating that here are many more of these."
                            data-src="{{ asset('img/services/articles.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Design + Marketing Articles</h2>
                    <p class="article__byline">Free</p>
                    <p class="">I write occassional articles that may be of use to anyone that wants to learn more about UI design.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="{{ route('articles.index') }}">Browse Articles</a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>

            {{-- Podcast Appearances --}}
            <div class="resource-option resource-option--last row vcenter">
                <img class="resource-option__image rounded lazy has-animation"
                            alt="Depicts Marc talking on a podcast, indicating that he appears on podcasts regularly."
                            data-src="{{ asset('img/services/podcasts.png') }}" height="250px" />
                <div class="resource-option__text">
                    <h3 class="h4 strip--mt margin-bottom--strip">Podcast Appearances</h2>
                    <p class="article__byline">Free</p>
                    <p class="">I regularly guest on industry podcasts to talk about UI design, sales, marketing, and business.</p>
                    <div class="resource-option__actions" x-data>
                        <a class="btn btn--tertiary" href="{{ route('podcast-appearances.index') }}">Browse Appearances</a>
                    </div>
                    {{-- <x-social-proof></x-social-proof> --}}
                </div>
            </div>
        </div>

        <x-about-me></x-about-me>

        {{-- Spacer --}}
        <div class="margin-top--lg"></div>
    </div>
</x-base>
