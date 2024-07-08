<x-base>
    <div class="container">
        <div class="row vcenter">
            <div class="col-7">
                <h1 class="text--hero strip--mt">I design websites that turn traffic into <span class="highlight">customers</span></h1>
                <p class="body--large">Simple, customer-centric landing pages that drive <strong>seriously awesome</strong> business results.</p>
                <div class="button-group" style="margin-top: 50px;">
                    <div class="glimmer-container">
                        <a href="#" class="btn btn--secondary btn--large">Book A Free Call</a>
                    </div>
                    {{-- <a href="#" class="btn btn--tertiary">Secondary CTA</a> --}}
                </div>
                <x-social-proof></x-social-proof>
            </div>
            <div class="col-5 vcenter">
                <div class="vcenter center">
                    <div class="lazy-wrapper">
                        <img class="rounded lazy" data-src="{{ asset('img/clarity-call-image.jpg') }}" height="493px" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row vcenter padding-top--lg padding-bottom--md">
            <div class="col-6">
                <h2 class="strip--mt">Advertising is hard.</h2>
                <p class="strip--mb">You'll be closing more business left and right with the insights from this call alone.  You'll be closing more business left and right with the insights from this call alone.</p>
                <p class="strip--mb">You used to pay for it once, install it, and run it. Whether on someone's computer, or a server for everyone, it felt like you owned it. And you did.</p>
                <p class="strip--mb"><strong>This doesn't work.</strong></p>
            </div>
            <div class="col-6">
                <ul class="normalize-list list--feature">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 6L18 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Pick my brain for up to 90 minutes.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 6L18 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Clarity on how to get people to subscribe to your software product.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 6L18 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Actionable steps to fix your funnel.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 6L18 18" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Pick my brain for up to 90 minutes.
                    </li>
                </ul>
            </div>
        </div>

        <div class="row vcenter padding-top--md padding-bottom--lg">
            <div class="col-6">
                <ul class="normalize-list list--feature">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Pick my brain for up to 90 minutes.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Clarity on how to get people to subscribe to your software product.
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Actionable steps to fix your funnel.
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <h2 class="strip--mt">What if you could <span class="highlight">double</span> your trial sign-ups?</h2>
                <p>You'll be closing more business left and right with the insights from this call alone.  You'll be closing more business left and right with the insights from this call alone.</p>
                <p class="strip--mb"><em>All this, without increasing your ad spend.</em></p>
            </div>
        </div>

        {{-- <x-roi-calculator></x-roi-calculator> --}}

        {{-- <div class="row vcenter">
            <div class="col-7">
                <h3>Todo</h3>
                <ul>
                    <li><s>Me vs. other providers.</s></li>
                    <li><s>The problem</s></li>
                    <li>The solution</li>
                    <li><s>Testimonials</s></li>
                    <li><s>Recent articles</s></li>
                    <li><s>How I can help</s></li>
                    <li><s>About Me</s></li>
                    <li><s>ROI calculator?</s></li>
                </ul>
            </div>
        </div> --}}

        <x-engagement-options></x-engagement-options>

        <x-comparison-chart></x-comparison-chart>

        <div class="row vcenter padding-top--sm padding-bottom--md">
            <div class="col-6 feature-item">
                <h3 class="h4 feature-item__header margin-top--strip margin-bottom--strip">
                    <div class="icon__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 20V10" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 20V4" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 20V16" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Results-driven design
                </h3>
                <p class="feature-item__body">I only work with software companies, so you can rest assured I'll be able to deliver.</p>
            </div>
            <div class="col-6 feature-item">
                <h3 class="h4 feature-item__header margin-top--strip margin-bottom--strip">
                    <div class="icon__wrapper">
                        <svg class="icon--emphasized" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M16 18L22 12L16 6" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6L2 12L8 18" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Software specialist
                </h3>
                <p class="feature-item__body">I only work with software companies, so you can rest assured I'll be able to deliver.</p>
            </div>
        </div>

        {{-- <div class="row padding-top--lg padding-bottom--sm">
            <div class="col-5">
                <h2 class="margin-top--strip">Recent Articles</h2>
                <p class="margin-bottom--strip">Articles about design, software product development, marketing, and conversion-rate optimization.</p>
                <a href="{{ route('articles.index') }}" class="btn btn--link margin-top--sm">
                    Browse All Articles
                </a>
            </div>
            <div class="col-7">
                <x-articles :limit="2"></x-articles>
            </div>
        </div> --}}

        <x-about-me></x-about-me>
        <div class="row margin-top--md margin-bottom--md">
            <div class="col-12">
                @php
                    $statistics = [
                        (object) ['label' => 'Design projects completed to this day', 'value' => '90+',],
                        (object) ['label' => 'Happy, frequently-returning customers', 'value' => '135',],
                        (object) ['label' => 'Est. new revenue generated for customers', 'value' => '$50M+',],
                    ];
                @endphp
                
                <x-statistics :statistics=$statistics></x-statistics>
            </div>
        </div>
    </div>
</x-base>
