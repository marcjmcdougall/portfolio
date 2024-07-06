<x-base>
    <div class="container">
        <div class="row vcenter">
            <div class="col-7">
                <h1 class="text--hero strip--mt">I design websites that turn traffic into <span class="highlight">customers.</span></h1>
                <p class="body--large">Simple, customer-centric design that drives <strong>seriously awesome</strong> business results.</p>
                <div class="button-group margin-top--md">
                    <div class="glimmer-container">
                        <a href="#" class="btn btn--secondary btn--large">Let's Talk</a>
                    </div>
                    {{-- <a href="#" class="btn btn--tertiary">Secondary CTA</a> --}}
                </div>
                <x-social-proof></x-social-proof>
            </div>
            <div class="col-5 vcenter">
                <div class="vcenter center">
                    <img class="rounded" src="{{ asset('img/clarity-call-image.jpg') }}" />
                </div>
            </div>
        </div>

        {{-- <div class="row padded">
            <x-testimonials type="consulting" limit="2" showPhoto="true" showRole="true"></x-testimonials>
        </div> --}}

        <div class="row vcenter padding-top--md padding-bottom--md">
            <div class="col-6">
                <div class="icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 20V10" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 20V4" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 20V16" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="h4">Results-driven design</h3>
                <p>I only work with software companies, so you can rest assured I'll be able to deliver.</p>
            </div>
            <div class="col-6">
                <div class="icon-wrapper">
                    <svg class="icon--emphasized" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M16 18L22 12L16 6" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 6L2 12L8 18" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="h4">Software specialist</h3>
                <p>I only work with software companies, so you can rest assured I'll be able to deliver.</p>
            </div>
        </div>

        <div class="row vcenter">
            <div class="col-7">
                <h3>Todo</h3>
                <ul>
                    <li>Me vs. other providers.</li>
                    <li>The problem.</li>
                    <li>The solution</li>
                    <li>Testimonials</li>
                    <li>Recent articles</li>
                    <li>Resources</li>
                    <li>About Me</li>
                </ul>
            </div>
        </div>

        <div class="row padded">
            <div class="col-5">
                <h2 class="margin-top--strip">Recent Articles</h2>
                <p>Articles about design, software product development, marketing, and conversion-rate optimization.</p>
                <a href="{{ route('articles.index') }}" class="btn btn--link margin-top--sm">Browse Articles</a>
                {{-- <form class="form form--stretch-inputs">
                    <x-input.base name="FNAME" label="First name" width="215" hide-label>
                        <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                    </x-input.base>

                    <x-input.base name="EMAIL" label="Email" hide-label>
                        <x-input.text-input name="EMAIL" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                    </x-input.base>

                    <input type="submit" value="Subscribe" class="btn btn--secondary" />
                </form> --}}
            </div>
            <div class="col-7">
                <x-articles :limit="4"></x-articles>
            </div>
        </div>
    </div>
</x-base>
