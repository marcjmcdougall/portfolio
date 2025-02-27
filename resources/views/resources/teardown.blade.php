<x-base hideNewsletter>
    <div class="container">
        <div class="row vcenter resource-hero">
            <div class="col-7">
                <div class="resource-hero__text">
                    <h1 class="resource-hero__title text--hero">Is your landing page optimized for <span class="highlight">conversions?</span></h1>
                    <p class="body--large resource-hero__body">I'll show you <em>exactly</em> why people aren't signing up for your software product.</p>
                    <ul class="normalize-list list--feature">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <strong>Prioritized</strong> conversion improvements.
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
                            Optional Figma mockup of proposed changes.
                        </li>
                    </ul>
                    <div class="button-group">
                        <div class="button-wrap" x-data>
                            <div class="glimmer-container">
                                <a href="#pricing-options" 
                                    data-scroll-padding="0" 
                                    data-scroll-duration="500"
                                class="btn btn--secondary btn--large">
                                    Choose Your Teardown
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
        <div class="row margin-top--xs">
            <x-testimonials type="clarity-call" limit="2" showPhoto="true" showRole="true"></x-testimonials>
        </div>

        <div class="row vcenter margin-top--lg padding-bottom--md">
            <div class="col-6">
                <h2 class="h3 strip--mt">What's in a landing page teardown, anyway?</h2>
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
                <h2 class="h3 strip--mt">What if this <span class="highlight">doubles</span> your trial sign-ups?</h2>
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
        </section>

        <x-about-me></x-about-me>

        <div class="row margin-top--md padding-bottom--sm">
            <div class="col-12">
                @php
                    $statistics = [
                        (object) ['label' => 'Delightful teardowns completed to date', 'value' => '86',],
                        (object) ['label' => 'Happy, frequently-returning customers', 'value' => '135',],
                        (object) ['label' => 'Est. new revenue generated for customers', 'value' => '$20M+',],
                    ];
                @endphp
                
                <x-statistics :statistics=$statistics></x-statistics>
            </div>
        </div>

        <div class="bg--gray padded rounded row vcenter margin-top--lg margin-bottom--lg">
            <div class="col-7">
                <h2 class="h3 strip--mt">Rather chat first?</h2>  
                <p class="">I'm always down to meet new folk.  Feel free to snag a 20 minutes with me to break the proverbial ice.</p>
                <div class="button-group">
                    <div class="button-wrap" x-data>
                        <div class="glimmer-container">
                            <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary">
                                    Book A Free Call
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