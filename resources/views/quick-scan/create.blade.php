<x-base> 
    <div class="container">
        <section class="quick-scan-hero">
            <div class="row">
                <div class="quick-scan-hero__text col-7">
                    <h1 class="text--hero margin-top--strip">Unlock serious <span class="highlight">revenue</span> in your landing page.</h1>
                    <p class="body--large">Scan your landing page for hidden conversion-rate optimization opportunuties.</p>
                    <form action="/resources/quick-scan" method="POST" class="form">
                        @csrf

                        <!-- URL Input -->
                        <div class="form-item">
                            <label class="form-group__label" for="url">Landing Page</label>
                            <input type="text" value="{{ old('url') }}" id="url" name="url" required placeholder="https://example.com">
                            @error('url')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email Input -->
                        <div class="form-item">
                            <label class="form-group__label" for="email">Your Email</label>
                            <input type="email" value="{{ old('email') }}" id="email" name="email" required placeholder="Email">
                            @error('email')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Consent Checkbox -->
                        <div>
                            <div class="form-item--checkbox">
                                <input type="checkbox" id="consent" name="consent" required>
                                <label for="consent">
                                    I agree to receive occasional (very fun) marketing emails.
                                </label>
                            </div>
                            @error('terms')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>

                        @error('limit_reached')
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Submit Button -->
                        <div class="quick-scan-hero__actions">
                            <div class="glimmer-container">
                                <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button>
                            </div>
                            <p class="newsletter-opt-in__aside margin-bottom--strip">100% free.  Limited to 1 analysis per day.</p>
                        </div>
                    </form>
                </div>
                <div class="col-5 vcenter">
                    <x-quick-scan-visualizer></x-quick-scan-visualizer>
                    {{-- <x-impact-visualizer></x-impact-visualizer> --}}
                </div>
            </div>
        </section>

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

        <section class="row vcenter padded">
            <div class="col-6">
                <h2 class="strip--mt">You could be sitting on a <span class="highlight">gold mine.</span></h2>
                {{-- <p class="strip--mb">Stop throwing money away.</p> --}}
                <p class="strip--mb">You've invested thousands if not <em>millions</em> driving visitors to your landing page, but those eyeballs are just <strong><em>floating out the door.</em></strong></p>
                <p class="strip--mb">What if 20% more of that hard-earned traffic converted directly to your bottom line?</p>
            </div>
            <div class="col-6">
                <x-impact-visualizer type="comparison" :showStats="false" graphTitle="Conversion funnel for {{ date('F Y') }}" graphValue="42165" graphValuePrefix="" />
            </div>
        </section>

        <section class="pricing-options padded">
            <div class="pricing-options__header col-8">
                <h2 class="strip--mt">Join the <span class="highlight">{{ $totalQuickScans }} others</span> that have generated a report so far</h2>
                {{-- <p class="strip--mb"><em>Well, there's technically two, but you get the point&hellip;</em></p> --}}
                <x-quick-scan-report-visiualizer></x-quick-scan-report-visiualizer>
            </div>
        </section>

        <x-about-me></x-about-me>

    </div>
</x-base>