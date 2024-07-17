<x-base hideNewsletter>
    <div class="container">
        <div class="row vcenter resource-hero">
            <div class="col-7">
                <div class="resource-hero__text">
                    <h1 class="resource-hero__title text--hero">Tired of traffic <span class="highlight">bouncing</span> without signing up?</h1>
                    <p class="body--large resource-hero__body">Let's discuss exactly why people aren't signing up for your software product.</p>
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
                            Clarity on how to get people to subscribe to your software product.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Actionable steps to fix your funnel.
                        </li>
                    </ul>
                    <div class="button-group">
                        <div class="glimmer-container">
                            <a href="#" class="btn btn--secondary btn--large">Book a Clarity Call</a>
                        </div>
                        {{-- <a href="#" class="btn btn--tertiary">Secondary CTA</a> --}}
                    </div>
                    <p class="newsletter-opt-in__aside margin-bottom--strip">One-time payment of $495.  100% refund guarantee.</p>
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
        <div class="row margin-top--xs">
            <x-testimonials type="clarity-call" limit="2" showPhoto="true" showRole="true"></x-testimonials>
        </div>

        <div class="row vcenter margin-top--lg padding-bottom--md">
            <div class="col-6">
                <h2 class="h3 strip--mt">Here's the problem.</h2>
                <p class="strip--mb">Let's face it — designing an effective landing page is one of the hardest things you have to do.</p>
                <p class="strip--mb">You can't read your customer's minds, so you put together a page that seems to look good, and hedge your bets by sending a TON of traffic to it.</p>
                <p class="strip--mb"><strong>Of course&hellip;this doesn't work.</strong></p>
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
                <p class="">You could spend another week or so worrying about what to do.  Or I could show you <strong>exactly</strong> what you need to do in a few hours.</p>
                <p>Todo:</p>
                <ul>
                    <li>Add checkmarks to this perhaps?</li>
                    <li>Money-back guarantee</li>
                    <li>Availability status / calendar</li>
                    <li>FAQ</li>
                </ul>
                <div class="button-group">
                    <div class="glimmer-container">
                        <a href="#" class="btn btn--secondary">Book a Clarity Call</a>
                    </div>
                </div>
                <p class="newsletter-opt-in__aside margin-top--xs margin-bottom--strip">One-time payment of $495.  100% refund guarantee.</p>
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