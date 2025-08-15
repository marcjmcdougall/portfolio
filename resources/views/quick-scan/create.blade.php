<x-base 
    hideNewsletter
    reCaptcha
    title="CRO QuickScan – Unlock hidden website conversion opportunities in minutes"
    description="Instantly identify conversion barriers and growth opportunities with our free website analysis tool. Get actionable CRO insights in minutes."
    ogTitle="Is your website optimized for conversions?"
    ogDescription="Scan your site for INSTANT insights on how to convert more customers."
    :ogImage="asset('img/social/cro-quick-scan.jpg')" > 
    <div class="container">
        <x-quick-scan-hero></x-quick-scan-hero>
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
            <x-testimonials type="teardown" limit="2" showPhoto="true" showRole="true" useShortContent="true"></x-testimonials>
        </div>

        <section class="row vcenter padded">
            <div class="col-6">
                <x-impact-visualizer type="comparison" :showStats="false" graphTitle="Conversion funnel for {{ date('F Y') }}" graphValue="42165" graphValuePrefix="" />
            </div>
            <div class="col-6">
                <h2 class="strip--mt">You could be sitting on a <span class="colorize underline has-animation">gold mine.</span></h2>
                {{-- <p class="strip--mb">Stop throwing money away.</p> --}}
                <p class="strip--mb">You've invested thousands if not <em>millions</em> driving visitors to your landing page, but those eyeballs are just <strong><em>floating out the door.</em></strong></p>
                <p class="strip--mb">What if 20% more of that hard-earned traffic converted directly to your bottom line?</p>
            </div>
        </section>

        <section class="quick-scan-report-visualizer__container padded">
            <div class="quick-scan-report-visualizer__header col-8">
                <h2 class="strip--mt">Join the <span class="highlight">{{ $totalQuickScans }}+ others</span> that have generated a report</h2>
                <p class="body--large strip--mb strip--mt"><em>(Real results are anonymized&hellip;of course)</em></p>
            </div>

            <x-quick-scan-report-visualizer></x-quick-scan-report-visualizer>
        </section>

        <x-about-me></x-about-me>

        <x-quick-scan-opt-in></x-quick-scan-opt-in>

    </div>
</x-base>