<section class="newsletter-opt-in">
    <div class="container">
        <div class="content-wrapper">
            <div class="row row--vcenter">
                <div class="col-6 newsletter-opt-in__image-container">
                    <img src="{{ asset('img/newsletter-image.jpg') }}" alt="Graphical depiction a newsletter">
                </div>
                <div class="col-6">
                    <div class="newsletter-opt-in__header">
                        <h3 class="newsletter-opt-in__title">Land more trial signups with this <span class="highlight">12-day email course.</span></h3>
                        <p class="newsletter-opt-in__body-text">Over the next 12 days, I'll show you exactly what I do to reliably boost trial conversion rates by 20-30%.</p>
                        {{-- <p class="newsletter-opt-in__body-text">No spam, unsubscribe at any time.</p> --}}

                        <form class="newsletter-opt-in__form">
                            <x-input.base name="FNAME" label="First name" hide-label>
                                <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                            </x-input.base>

                            <x-input.base name="EMAIL" label="Email" hide-label>
                                <x-input.text-input name="EMAIL" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                            </x-input.base>

                            <div class="glimmer-container">
                                <input type="submit" value="Enroll Now" class="btn btn--secondary btn--glimmer" />
                            </div>
                            <p class="newsletter-opt-in__aside">No spam, unsubscribe at any time.</p>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="newsletter-opt-in__testimonials">
                <div class="row">
                    <div class="col-12">
                        <div class="separator">
                            <span class="separator__line"></span>
                            <label class="separator__text section-label">What subscribers say</label>
                            <span class="separator__line"></span>
                        </div>
                    </div>
                </div>
                <div class="testimonials row">
                    <div class="testimomial">
                        <div class="testimonial__text">
                            <p>“Hands down, this is the <span class="highlight highlight--subtle">best welcome I've ever had to a newsletter</span>, and I've signed up for a LOT of newsletters.”</p>
                            <p class="testimonial__attribution">Rob White</p>
                        </div>
                    </div>
                    <div class="testimomial">
                        <div class="testimonial__text">
                            <p>“Hands down, this is the <span class="highlight highlight--subtle">best welcome I've ever had to a newsletter</span>, and I've signed up for a LOT of newsletters.”</p>
                            <p class="testimonial__attribution">Rob White</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>