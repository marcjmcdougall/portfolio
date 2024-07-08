<x-base hideNewsletter>
    <div class="container">
        <div class="row vcenter resource-hero">
            <div class="col-7">
                <div class="resource-hero__text">
                    <h1 class="resource-hero__title">Learn how to design landing pages<span class="highlight">that sell for you.</span></h1>
                    <p class="body--large resource-hero__body">I'll show you exactly why people aren't signing up for your software product.</p>
                    <ul class="normalize-list list--feature">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Talk with an expert for up to 90 minutes.
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
                    <form class="newsletter-opt-in__form" style="max-width: 350px;">
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
            <div class="col-5 vcenter">
                <div class="resource-hero__image-wrapper vcenter center">
                    <img class="resource-hero__image rounded" src="{{ asset('img/clarity-call-image.jpg') }}" />
                </div>
            </div>
        </div>
    </div>
</x-base>