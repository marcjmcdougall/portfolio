<section id="homepage-hero" 
            class="row">
    <div class="col-7">
        <h1 class="text--hero strip--mt">I design websites that turn traffic into <span class="highlight">customers.</span></h1>
        <p class="body--large">Simple, customer-centric landing pages that drive <strong>seriously awesome</strong> business results.</p>
        <div class="cta-wrap">
            <div class="button-group" style="margin-top: 50px;">
                <div class="button-wrap" x-data>
                    <div class="glimmer-container">
                        <span class="blob"></span>
                        <a href="#" 
                            x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                            class="btn btn--secondary btn--large homepage-hero__btn">
                                Book Discovery Call
                                <span class="keybind">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M9.84375 2.625C10.2499 2.625 10.6393 2.78633 10.9265 3.07349C11.2137 3.36066 11.375 3.75014 11.375 4.15625C11.375 4.56236 11.2137 4.95184 10.9265 5.23901C10.6393 5.52617 10.2499 5.6875 9.84375 5.6875H8.3125V4.15625C8.3125 3.75014 8.47383 3.36066 8.76099 3.07349C9.04816 2.78633 9.43764 2.625 9.84375 2.625Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.6875 5.6875H4.15625C3.75014 5.6875 3.36066 5.52617 3.07349 5.23901C2.78633 4.95184 2.625 4.56236 2.625 4.15625C2.625 3.75014 2.78633 3.36066 3.07349 3.07349C3.36066 2.78633 3.75014 2.625 4.15625 2.625C4.56236 2.625 4.95184 2.78633 5.23901 3.07349C5.52617 3.36066 5.6875 3.75014 5.6875 4.15625V5.6875Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.3125 8.3125H9.84375C10.2499 8.3125 10.6393 8.47383 10.9265 8.76099C11.2137 9.04816 11.375 9.43764 11.375 9.84375C11.375 10.2499 11.2137 10.6393 10.9265 10.9265C10.6393 11.2137 10.2499 11.375 9.84375 11.375C9.43764 11.375 9.04816 11.2137 8.76099 10.9265C8.47383 10.6393 8.3125 10.2499 8.3125 9.84375V8.3125Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4.15625 11.375C3.75014 11.375 3.36066 11.2137 3.07349 10.9265C2.78633 10.6393 2.625 10.2499 2.625 9.84375C2.625 9.43764 2.78633 9.04816 3.07349 8.76099C3.36066 8.47383 3.75014 8.3125 4.15625 8.3125H5.6875V9.84375C5.6875 10.2499 5.52617 10.6393 5.23901 10.9265C4.95184 11.2137 4.56236 11.375 4.15625 11.375Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.3125 5.6875H5.6875V8.3125H8.3125V5.6875Z" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> 
                                    K
                                </span>
                        </a>
                    </div>
                </div>
                {{-- <a href="{{ route('quick-scan.create') }}" class="btn btn--large btn--tertiary">Free Site Scan</a> --}}
            </div>
            <x-social-proof></x-social-proof>
        </div>
    </div>
    <div class="col-5 vcenter">
        <div class="vcenter center">
            {{-- <div class="lazy-wrapper">
                <img class="lazy" data-src="{{ asset('img/homepage-vis.jpg') }}" width="393px" />
            </div> --}}
            <x-impact-visualizer />
        </div>
    </div>
</section>