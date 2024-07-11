<x-base>
    <div class="container">
        <div class="row resource-hero vcenter">
            <div class="col-7">
                <div class="resource-hero__text">
                    <h1 class="resource-hero__title text--hero">Learn to design landing pages that <span class="highlight">sell for you.</span></h1>
                    <p class="body--large resource-hero__body">A 12-day email course that'll help you land more trial signups for your software company.</p>
                    <ul class="normalize-list list--feature">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Actionable insights to improve your designs.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            In-depth conversion-rate optimization case studies.
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Occassional memes and good times.
                        </li>
                    </ul>
                    <form class="form--inline form--stretch-inputs">
                        {{-- <x-input.base name="FNAME" label="First name" hide-label>
                            <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                        </x-input.base> --}}

                        <x-input.base name="EMAIL" label="Email" hideLabel width="300">
                            <x-input.text-input name="EMAIL" placeholder="Your best email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                        </x-input.base>

                        <div class="glimmer-container">
                            <input type="submit" value="Enroll Now" class="btn btn--secondary btn--glimmer" style="height: 45px;" />
                        </div>
                        {{-- <p class="newsletter-opt-in__aside">No spam, unsubscribe at any time.</p> --}}
                    </form>

                    <p class="newsletter-opt-in__aside">No spam, unsubscribe at any time.</p>
                </div>
            </div>
            <div class="col-5 margin-top--sm">
                <div class="resource-hero__image-wrapper center">
                    <x-newsletter-visualizer theme="light"></x-newsletter-visualizer>   
                </div>
            </div>
        </div>

        <section class="testimonial__wrapper margin-top--md">
            <div class="row">
                <div class="col-12">
                    <div class="separator">
                        <span class="separator__line"></span>
                        <label class="separator__text section-label">What subscribers say</label>
                        <span class="separator__line"></span>
                    </div>
                </div>
            </div>
            <x-testimonials limit="2" type="newsletter"></x-testimonials>
        </section>

        <div class="row vcenter padded">
            <div class="col-6">
                <h2 class="strip--mt">Todo</h2>
                <ul>
                    <li>What's in the course?</li>
                    <li>Example lesson?</li>
                    <li>About Me</li>
                    <li>Secondary CTA</li>
                </ul>
            </div>
        </div>

        <x-about-me></x-about-me>         
    </div>
</x-base>