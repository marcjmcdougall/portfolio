<x-base
    title="Marc McDougall – Is your landing page optimized for conversions?"
    description="Get a professional teardown of your landing page with actionable conversion insights. Discover exactly why visitors aren't converting and how to fix it."
    ogTitle="Is your landing page optimized for conversions? Get a professional teardown"
    ogDescription="I'll show you exactly why people aren't signing up for your software product with prioritized conversion improvements and a video walkthrough."
    hideNewsletter>
    <div class="container">
        <div class="row vcenter resource-hero">
            <div class="col-7">
                <div class="resource-hero__text">
                    <h1 class="text--hero resource-hero__title ">Unlock serious <span class="highlight">revenue</span> in your landing page.</h1>
                    {{-- <h1 class="resource-hero__title text--hero">Is your landing page optimized for <span class="highlight">conversions?</span></h1> --}}
                    <p class="body--large resource-hero__body">I'll show you <em>exactly</em> why people aren't signing up for your software product.</p>
                    <ul class="normalize-list list--feature">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Prioritized conversion improvements.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Video walkthrough of recommendations.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            (Optional) Figma mockup of proposed changes.
                        </li>
                    </ul>
                    <div class="button-group">
                        <div class="button-wrap" x-data>
                            <div class="glimmer-container">
                                <a href="#pricing-options" 
                                    data-scroll-padding="0" 
                                    data-scroll-duration="500"
                                class="btn btn--secondary btn--large resource-hero__cta-button">
                                    Choose Your Teardown
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M9 2.8125V15.1875" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.9375 10.125L9 15.1875L14.0625 10.125" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        {{-- <a href="#" class="btn btn--tertiary">Secondary CTA</a> --}}
                    </div>
                    <p class="newsletter-opt-in__aside margin-bottom--strip">Limited slots available.  100% refund guarantee.</p>
                </div>
            </div>
            <div class="col-5 vcenter">
                <div class="resource-hero__image-wrapper vcenter center">
                    {{-- <div class="lazy-wrapper">
                        <img class="resource-hero__image rounded lazy" data-src="{{ asset('img/clarity-call-image.jpg') }}" height="493px" />
                    </div> --}}
                    <x-task-visualizer></x-task-visualizer>
                </div>
            </div>
        </div>
        <div class="row margin-top--md">
            <div class="col-12">
                <div class="separator">
                    <span class="separator__line"></span>
                    <label class="separator__text section-label">What my customers say</label>
                    <span class="separator__line"></span>
                </div>
            </div>
        </div>
        <div class="row margin-top--xs padding-bottom--sm">
            <x-testimonials type="teardown" limit="2" showPhoto="true" showRole="true"></x-testimonials>
        </div>

        <div class="row vcenter margin-top--lg padding-bottom--md">
            <div class="col-6">
                <h2 class="strip--mt text--bold">What's in a teardown, anyway?</h2>
                <p class="strip--mt">The teardown is my simplest intervention, that requires <strong>almost none of your time.</strong></p>
                <p class="strip--mt">It's the easiest way to take your landing page to the next level, without hiring anyone.</p>
            </div>
            <div class="col-6">
                <x-teardown-visualizer></x-teardown-visualizer>
            </div>
        </div>

        <div class="row vcenter padded">
            <div class="col-6">
                <x-impact-visualizer type="comparison" :showStats="false" graphTitle="Conversion funnel for {{ date('F Y') }}" graphValue="42165" graphValuePrefix="" />
            </div>
            <div class="col-6">
                <h2 class="strip--mt text--bold">What if this <span class="highlight">doubles</span> your trial sign-ups?</h2>
                <p class="strip--mb">Imagine <em>reducing</em> your marketing spend and getting the same results.</p>
                <p class="strip--mb">What would that mean for your business?</p>
                <p class="strip--mb">Normally, this sort of optimization takes months for companies to figure out.</p>
                <p class="strip--mb">So&hellip;if you could get some guidance from someone that's been doing this <strong>for decades</strong>, wouldn't you take it?</p>
            </div>
        </div>

        <section id="pricing-options" class="pricing-options padded">
            <div class="pricing-options__header col-8">
                <h2 class="strip--mt">Choose the option that's right for you 👇</h2>
                {{-- <p class="strip--mb"><em>Well, there's technically two, but you get the point&hellip;</em></p> --}}
            </div>

            <div class="pricing-options__options">
                <div class="pricing-options__option pricing-options__option--preferred">
                    <h2 class="pricing-options__option__title h4 margin-top--strip margin-bottom--strip">Teardown + Mockup</h2>
                    <p class="pricing-options__option__description">Get ranked conversion improvements for your landing page + a mockup.</p>
                    <p class="pricing-options__option__price">$<span class="count-up" data-count="995">995</span> <span class="pricing-options__option__currency">USD</span></p>
                        <div class="button-wrap" x-data>
                            <div class="glimmer-container">
                                <a href="https://buy.stripe.com/14k00ObZu6fTaFa002"
                                target="_blank"
                                rel="noopener"
                                class="btn btn--secondary">
                                    Get Teardown + Mockup
                                </a>
                            </div>
                        </div>
                    <div class="pricing-options__options__benefits">
                        <ul class="normalize-list list--feature">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Single landing page teardown.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Video walkthrough of recommendations.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Figma mockup of proposed changes.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                (Optional) Handover meeting.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pricing-options__option">
                    <h2 class="pricing-options__option__title h4 margin-top--strip margin-bottom--strip">Teardown Only</h2>
                    <p class="pricing-options__option__description">Get ranked conversion improvements for your landing page.</p>
                    <p class="pricing-options__option__price">$<span class="count-up" data-count="495">0</span> <span class="pricing-options__option__currency">USD</span></p>
                    {{-- <a href="#" class="btn btn--tertiary">Get Teardown Only</a> --}}
                    <a href="https://buy.stripe.com/3cs3d03sYdIl28E3cd"
                        target="_blank"
                        rel="noopener"
                        class="btn btn--tertiary">
                            Get Teardown Only
                    </a>
                    <div class="pricing-options__options__benefits">
                        <ul class="normalize-list list--feature">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Single landing page teardown.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Video walkthrough of recommendations.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                (Optional) Handover meeting.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.75 5.25L5.25 18.75" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.75 18.75L5.25 5.25" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                No Figma mockup
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pricing-options__option pricing-options__option--featured">
                <div class="pricing-options__option__text">
                    <h2 class="pricing-options__option__title h4 margin-top--strip margin-bottom--strip">
                        Automatic Site Scan
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20.25 12V16.5" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 14.25H22.5" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.5 3.75V8.25" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.25 6H9.75" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.75 17.25V20.25" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.25 18.75H17.25" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.5 7.5L16.5 10.5" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.0305 3.96951L3.96978 17.0302C3.67689 17.3231 3.67689 17.798 3.96978 18.0909L5.9088 20.0299C6.20169 20.3228 6.67657 20.3228 6.96946 20.0299L20.0302 6.96919C20.3231 6.6763 20.3231 6.20143 20.0302 5.90853L18.0911 3.96951C17.7983 3.67662 17.3234 3.67662 17.0305 3.96951Z" stroke="#020202" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none">
                            <path d="M18.75 21H5.25C5.05109 21 4.86032 20.921 4.71967 20.7803C4.57902 20.6397 4.5 20.4489 4.5 20.25V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H14.25L19.5 8.25V20.25C19.5 20.4489 19.421 20.6397 19.2803 20.7803C19.1397 20.921 18.9489 21 18.75 21Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.25 3V8.25H19.5" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.625 16.5C13.0747 16.5 14.25 15.3247 14.25 13.875C14.25 12.4253 13.0747 11.25 11.625 11.25C10.1753 11.25 9 12.4253 9 13.875C9 15.3247 10.1753 16.5 11.625 16.5Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.4814 15.7312L15.0002 17.25" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </h2>
                    <p class="pricing-options__option__description">Rather just get some quick insights for free?  The QuickScan may your best bet.</p>
                    <p class="pricing-options__option__price">$<span class="count-up" data-count="0">0</span> <span class="pricing-options__option__currency">USD</span></p>
                    <div class="pricing-options__options__benefits">
                        <ul class="normalize-list list--feature">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Get answers in less than 3 minutes.
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Data-driven insights
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.75 5.25L5.25 18.75" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.75 18.75L5.25 5.25" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                No manual review
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.75 5.25L5.25 18.75" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.75 18.75L5.25 5.25" stroke="#F93827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                No Figma mockup
                            </li>
                        </ul>
                    </div>
                </div>
                <x-quick-scan-form></x-quick-scan-form>
            </div>
        </section>

        <x-about-me></x-about-me>

        <div class="bg--gray padded rounded row vcenter margin-top--lg margin-bottom--lg">
            <div class="col-7">
                <h2 class="h3 strip--mt">Rather chat first?</h2>  
                <p class="">I'm always down to meet new folk.  Feel free to snag 20 minutes with me to break the proverbial ice.</p>
                <div class="button-group">
                    <div class="button-wrap" x-data>
                        <div class="glimmer-container">
                            <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary">
                                    Free Discovery Call
                            </a>
                        </div>
                    </div>
                </div>
                <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">Limited availability. 100% corny joke guarantee.</p>
            </div>
            <div class="col-5">
                <x-testimonials :limit="1" :showPhoto="true" :showRole="true" type="teardown"></x-testimonials>
            </div>
        </div>

        <div class="row margin-bottom--lg">
            <div class="col-12">
                <h2 class="h3 strip--mt">Still have questions?</h2>
                <div class="questions">
                    <x-questions topic="teardown"></x-questions>
                </div>
            </div>
        </div>

    </div>
</x-base>