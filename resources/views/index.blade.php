<x-base>
    <div class="container">
        <x-redirect-detector></x-redirect-detector>
        <x-homepage-hero></x-homepage-hero>

        {{-- <x-brands-list></x-brands-list> --}}

        <section class="feature-items row vcenter padding-top--lg padding-bottom--sm">
            <div class="col-6 feature-item">
                <h2 class="h4 feature-item__header margin-top--strip margin-bottom--strip">
                    <div class="icon__wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 20V10" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 20V4" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 20V16" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Results-driven design
                </h2>
                {{-- <p class="feature-item__body margin-bottom--strip">My design practice is focused on one thing: getting real results for my customers.</p> --}}
                <p class="feature-item__body margin-bottom--strip">Every design decision is driven by a single purpose: getting real results for customers.</p>
            </div>
            <div class="col-6 feature-item">
                <h2 class="h4 feature-item__header margin-top--strip margin-bottom--strip">
                    <div class="icon__wrapper">
                        <svg class="icon--emphasized" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M16 18L22 12L16 6" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6L2 12L8 18" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    Software specialist
                </h2>
                {{-- <p class="feature-item__body margin-bottom--strip">I only work with software companies, so you can rest assured I'll be able to deliver.</p> --}}
                <p class="feature-item__body margin-bottom--strip">Every project benefits from deep software industry expertise at every turn.</p>
            </div>
        </section>

        <section class="row vcenter margin-top--lg padding-bottom--sm">
            <div class="col-6">
                <h2 class="h3 strip--mt">Advertising is hard.</h2>
                <p class="strip--mb">Let's face it — designing an effective landing page is one of the hardest things you have to do.</p>
                <p class="strip--mb">You put together a page that seems to look good, and send a <em>TON</em> of traffic to it.</p>
                <p class="strip--mb"><strong>Of course&hellip;this only takes you so far.</strong></p>
            </div>
            <div class="col-6">
                <x-benefit-item text="Uncertain impact" type="negative" />
                <x-benefit-item text="Uncertain campaign efficiency" type="negative" />
                <x-benefit-item text="No A/B testing" type="negative" />
                <x-benefit-item text="Advertising dollars wasted" type="negative" />
            </div>
        </section>

        <section class="row vcenter margin-top--lg padding-bottom--sm">
            <div class="col-6 mobile--bottom">
                <x-impact-visualizer type="comparison" :showStats="false" graphTitle="Conversions for {{ date('F Y') }}" graphValue="42165" graphValuePrefix="" />
            </div>
            <div class="col-6">
                <h2 class="h3 strip--mt">What if you could <span class="highlight">double</span> your trial sign-ups?</h2>
                {{-- <p class="strip--mb">You could always spend your way out of a bad landing page.</p> --}}
                <p class="strip--mb">If you throw enough traffic at your landing page, eventually <em>someone</em> will sign up, right?</p>
                <p class="strip--mb">But&hellip;What if you had a landing page that printed out new signups?</p>
                <p class="strip--mb"><strong><em>&hellip;Without increasing your ad spend by a single dollar.</em></strong></p>
            </div>
        </section>

        <x-comparison-chart></x-comparison-chart>

        <x-about-me></x-about-me>

        <section class="row margin-top--md padding-bottom--sm">
            <div class="col-12">
                @php
                    $statistics = [
                        (object) ['label' => 'Design projects completed to this day', 'value' => '670+',],
                        (object) ['label' => 'Happy, frequently-returning customers', 'value' => '550',],
                        (object) ['label' => 'Est. new revenue generated for customers', 'value' => '$100M+',],
                    ];
                @endphp
                
                <x-statistics :statistics=$statistics></x-statistics>
            </div>
        </section>

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
    </div>
</x-base>
