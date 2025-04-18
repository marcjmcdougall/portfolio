<section class="newsletter-opt-in margin-bottom--md">
    <div class="container">
        <div class="content-wrapper">
            <div class="row row--vcenter">
                <div class="col-6 newsletter-opt-in__image-container">
                    <x-newsletter-visualizer />
                </div>
                <div class="col-6">
                    <div class="newsletter-opt-in__header">
                        <h3 class="newsletter-opt-in__title">Get more sign-ups with this <span class="colorize underline">10-day</span> email course.</h3>
                        <p class="newsletter-opt-in__body-text">Over the next 10 days, I'll show you exactly what I do to reliably boost trial conversion rates by 20-30%.</p>

                        <form class="newsletter-opt-in__form" method="post" action="https://app.convertkit.com/forms/6852494/subscriptions">
                            <x-input.base name="fields[first_name]" label="First name" hide-label>
                                <x-input.text-input name="fields[first_name]" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                            </x-input.base>

                            <x-input.base name="email_address" label="Email" hide-label>
                                <x-input.text-input name="email_address" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                            </x-input.base>

                            <div class="glimmer-container">
                                <span class="blob"></span>
                                <input type="submit" value="Enroll Now" class="btn btn--secondary" />
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
                    @php
                        $filteredTestimonials = $testimonials->filter(function ($testimonial) {
                            return in_array('newsletter', $testimonial->type);
                        })->take(2);
                    @endphp
                    @forelse ($filteredTestimonials as $testimonial)
                        <x-testimonials.excerpt :testimonial=$testimonial></x-testimonial.excerpt>
                    @empty
                        <p>No testimonials to show!</p>
                    @endforelse
                    {{-- <div class="testimomial">
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
                    </div> --}}
                </div>
            </div>
            {{-- <svg class="newsletter-opt-in__bg" xmlns='http://www.w3.org/2000/svg' width='100%' viewBox='0 0 1600 800'><rect fill='#EBF3FE' width='1600' height='800'/><g fill-opacity='1'><path fill='#d7e7fd'  d='M486 705.8c-109.3-21.8-223.4-32.2-335.3-19.4C99.5 692.1 49 703 0 719.8V800h843.8c-115.9-33.2-230.8-68.1-347.6-92.2C492.8 707.1 489.4 706.5 486 705.8z'/><path fill='#c4dbfc'  d='M1600 0H0v719.8c49-16.8 99.5-27.8 150.7-33.5c111.9-12.7 226-2.4 335.3 19.4c3.4 0.7 6.8 1.4 10.2 2c116.8 24 231.7 59 347.6 92.2H1600V0z'/><path fill='#b0cefb'  d='M478.4 581c3.2 0.8 6.4 1.7 9.5 2.5c196.2 52.5 388.7 133.5 593.5 176.6c174.2 36.6 349.5 29.2 518.6-10.2V0H0v574.9c52.3-17.6 106.5-27.7 161.1-30.9C268.4 537.4 375.7 554.2 478.4 581z'/><path fill='#9cc2f9'  d='M0 0v429.4c55.6-18.4 113.5-27.3 171.4-27.7c102.8-0.8 203.2 22.7 299.3 54.5c3 1 5.9 2 8.9 3c183.6 62 365.7 146.1 562.4 192.1c186.7 43.7 376.3 34.4 557.9-12.6V0H0z'/><path fill='#89B5F8'  d='M181.8 259.4c98.2 6 191.9 35.2 281.3 72.1c2.8 1.1 5.5 2.3 8.3 3.4c171 71.6 342.7 158.5 531.3 207.7c198.8 51.8 403.4 40.8 597.3-14.8V0H0v283.2C59 263.6 120.6 255.7 181.8 259.4z'/><path fill='#79abf7'  d='M1600 0H0v136.3c62.3-20.9 127.7-27.5 192.2-19.2c93.6 12.1 180.5 47.7 263.3 89.6c2.6 1.3 5.1 2.6 7.7 3.9c158.4 81.1 319.7 170.9 500.3 223.2c210.5 61 430.8 49 636.6-16.6V0z'/><path fill='#69a1f6'  d='M454.9 86.3C600.7 177 751.6 269.3 924.1 325c208.6 67.4 431.3 60.8 637.9-5.3c12.8-4.1 25.4-8.4 38.1-12.9V0H288.1c56 21.3 108.7 50.6 159.7 82C450.2 83.4 452.5 84.9 454.9 86.3z'/><path fill='#5a98f5'  d='M1600 0H498c118.1 85.8 243.5 164.5 386.8 216.2c191.8 69.2 400 74.7 595 21.1c40.8-11.2 81.1-25.2 120.3-41.7V0z'/><path fill='#4a8ef4'  d='M1397.5 154.8c47.2-10.6 93.6-25.3 138.6-43.8c21.7-8.9 43-18.8 63.9-29.5V0H643.4c62.9 41.7 129.7 78.2 202.1 107.4C1020.4 178.1 1214.2 196.1 1397.5 154.8z'/><path fill='#3A84F3'  d='M1315.3 72.4c75.3-12.6 148.9-37.1 216.8-72.4h-723C966.8 71 1144.7 101 1315.3 72.4z'/></g></svg> --}}
        </div>
    </div>
</section>