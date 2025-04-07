<x-base>
    <div class="container">
        <x-redirect-detector></x-redirect-detector>
        <x-announcement></x-announcement>
        <x-homepage-hero></x-homepage-hero>
        {{-- <x-quick-scan-hero></x-quick-scan-hero> --}}
        {{-- <x-brands-list :animated="true" :marginTop="10"></x-brands-list> --}}
        <x-benefits></x-benefits>

        <section class="row vcenter margin-top--lg padding-bottom--sm">
            <div class="col-6">
                <h2 class="strip--mt">Advertising is hard.</h2>
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
                <h2 class="strip--mt">What if you could <span class="highlight">double</span> your trial sign-ups?</h2>
                {{-- <p class="strip--mb">You could always spend your way out of a bad landing page.</p> --}}
                <p class="strip--mb">If you throw enough traffic at your landing page, eventually <em>someone</em> will sign up, right?</p>
                <p class="strip--mb">But&hellip;What if you had a landing page that printed out new signups?</p>
                <p class="strip--mb"><strong><em>&hellip;Without increasing your ad spend by a single dollar.</em></strong></p>
            </div>
        </section>

        <x-comparison-chart></x-comparison-chart>

        <x-about-me></x-about-me>

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
