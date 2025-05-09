<x-base 
    title="Marc McDougall – Get quick insights on your landing page"
    description="Book a 90-minute clarity call to uncover exactly why people aren't signing up for your software product and get actionable conversion tips."
    ogTitle="Tired of traffic bouncing without signing up? Let's talk."
    ogDescription="Book a 90-minute clarity call to uncover exactly why people aren't signing up for your software product and get actionable conversion tips."
    hideNewsletter>
    <div class="container">
        <div class="row vcenter resource-hero">
            <div class="col-7">
                <div class="resource-hero__text">
                    {{-- <h1 class="resource-hero__title text--hero">Tired of traffic <span class="colorize underline has-animation">bouncing</span> before sign-up?</h1> --}}
                    <h1 class="resource-hero__title text--hero">Struggling with designs that don't <span class="colorize underline">deliver?</span></h1>
                    <p class="body--large resource-hero__body">One call with a design expert can save you *months* of spinning your wheels.</p>
                    <ul class="normalize-list list--feature">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Workshop with an expert for up to 90 minutes.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Clarity on how to make your interface simpler, or more clear.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Actionable steps to fix your design.
                        </li>
                    </ul>
                    <div class="button-group">
                        <div class="button-wrap" x-data>
                            <div class="glimmer-container">
                                <span class="blob"></span>
                                <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/clarity-call?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary btn--large">
                                    Book A Clarity Call
                                </a>
                            </div>
                        </div>
                        {{-- <a href="#" class="btn btn--tertiary">Secondary CTA</a> --}}
                    </div>
                    <p class="newsletter-opt-in__aside margin-bottom--strip">Limited availability.  100% refund guarantee.</p>
                </div>
            </div>
            <div class="col-5 vcenter">
                <div class="resource-hero__image-wrapper vcenter center">
                    {{-- <div class="lazy-wrapper">
                        <img class="resource-hero__image rounded lazy" data-src="{{ asset('img/clarity-call-image.jpg') }}" height="493px" />
                    </div> --}}
                    <x-clarity-call-visualizer></x-clarity-call-visualizer>
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
        <div class="row margin-top--xs padding-bottom-sm">
            <x-testimonials type="clarity-call" limit="2" showPhoto="true" showRole="true"></x-testimonials>
        </div>

        <div class="row vcenter margin-top--lg padding-bottom--md">
            <div class="col-6">
                <h2 class="strip--mt text--bold">Design doesn't have to be hard.</h2>
                <p class="strip--mb">Once you deeply understand your customer's needs, landing pages write themselves.</p>
                <p class="strip--mb">But&hellip;it's tough to understand their needs if you're too in the weeds.</p>
                <p class="strip--mb"><strong>Sometimes, you just need an external perspective.</strong></p>
            </div>
            <div class="col-6">
                <x-benefit-item text="Uncertain of how to have an impact" type="negative" />
                <x-benefit-item text="Hard to measure campaign success" type="negative" />
                <x-benefit-item text="No A/B testing" type="negative" />
                <x-benefit-item text="Wasting advertising dollars" type="negative" />
            </div>
        </div>

        <div class="row vcenter padded">
            <div class="col-6">
                <x-impact-visualizer type="comparison" :showStats="false" graphTitle="Conversion funnel for {{ date('F Y') }}" graphValue="42165" graphValuePrefix="" />
            </div>
            <div class="col-6">
                <h2 class="strip--mt text--bold">What if you could <span class="colorize underline has-animation">double</span> your trial sign-ups?</h2>
                <p class="strip--mb">You could always spend your way out of a bad landing page.</p>
                <p class="strip--mb">Throw enough money at it and eventually <em>someone</em> will sign up, right?</p>
                <p class="strip--mb">Or&hellip; you could get some guidance from someone that's done this <strong>hundreds of times.</strong></p>
            </div>
        </div>

        <x-about-me></x-about-me>

        <div class="bg--gray padded rounded row vcenter margin-top--lg margin-bottom--md">
            <div class="col-7">
                <h2 class="h3 strip--mt newsletter-opt-in__title">Ready to chat?</h2>  
                <p class="">You could spend another week or so worrying about what to do.  Or&hellip;I could show you <strong>exactly</strong> what you need to do in a few hours.</p>
                {{-- <ul>
                    <li>Add checkmarks to this perhaps?</li>
                    <li>Money-back guarantee</li>
                    <li>Availability status / calendar</li>
                    <li>FAQ</li>
                </ul> --}}

                <div class="button-group">
                    <div class="button-wrap" x-data>
                        <div class="glimmer-container glimmer-container--light">
                            <span class="blob"></span>
                            <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/clarity-call?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary">
                                    Book A Clarity Call
                            </a>
                        </div>
                    </div>
                </div>
                <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">Limited availability. 100% refund guarantee.</p>
            </div>
            <div class="col-5">
                <x-testimonials :limit="1" :showPhoto="true" :showRole="true" type="clarity-call"></x-testimonials>
            </div>
        </div>

        <div class="row padded margin-bottom--lg">
            <div class="col-12">
                <h2 class="h3 strip--mt">Still have questions?</h2>
                <div class="questions">
                    <x-questions topic="clarity-call"></x-questions>
                </div>
            </div>
        </div>

    </div>
</x-base>