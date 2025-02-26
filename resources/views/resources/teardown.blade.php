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
                                <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/clarity-call?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary btn--large">
                                    Choose Your Audit
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
                <h2 class="h3 strip--mt">What if you could <span class="highlight">double</span> your trial sign-ups?</h2>
                <p class="strip--mb">You could always spend your way out of a bad landing page.</p>
                <p class="strip--mb">Throw enough money at it and eventually <em>someone</em> will sign up, right?</p>
                <p class="strip--mb">But what if it could be easier?  What if you could get some guidance from someone that's done this <strong>hundreds of times?</strong></p>
            </div>
        </div>

        <x-about-me></x-about-me>

        <div class="row margin-top--md padding-bottom--sm">
            <div class="col-12">
                @php
                    $statistics = [
                        (object) ['label' => 'Delightful calls completed to this date', 'value' => '227',],
                        (object) ['label' => 'Happy, frequently-returning customers', 'value' => '135',],
                        (object) ['label' => 'Est. new revenue generated for customers', 'value' => '$20M+',],
                    ];
                @endphp
                
                <x-statistics :statistics=$statistics></x-statistics>
            </div>
        </div>

        <div class="bg--gray padded rounded row vcenter margin-top--lg margin-bottom--lg">
            <div class="col-7">
                <h2 class="h3 strip--mt">Ready to chat?</h2>  
                <p class="">You could spend another week or so worrying about what to do.  Or&hellip;I could show you <strong>exactly</strong> what you need to do in a few hours.</p>
                {{-- <ul>
                    <li>Add checkmarks to this perhaps?</li>
                    <li>Money-back guarantee</li>
                    <li>Availability status / calendar</li>
                    <li>FAQ</li>
                </ul> --}}

                <div class="button-group">
                    <div class="button-wrap" x-data>
                        <div class="glimmer-container">
                            <a href="#" 
                                x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/clarity-call?text_color=353535&primary_color=3a84f3'});return false;" 
                                class="btn btn--secondary">
                                    Book A Clarity Call
                            </a>
                        </div>
                    </div>
                </div>
                <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">One-time payment of $495.  100% refund guarantee.</p>
            </div>
            <div class="col-5">
                <x-testimonials :limit="1" :showPhoto="true" :showRole="true" type="clarity-call"></x-testimonials>
            </div>
        </div>

        <div class="row margin-bottom--lg">
            <div class="col-12">
                <h2 class="h3 strip--mt">Still have questions?</h2>
                <div class="questions">
                    <x-questions topic="clarity-call"></x-questions>
                </div>
            </div>
        </div>

    </div>
</x-base>