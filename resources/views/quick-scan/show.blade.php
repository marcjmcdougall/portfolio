<x-base
    hideNewsletter
    :ogImage="$quickScan->screenshot_path->isSuccess() ? asset('storage/' . $quickScan->screenshot_path->getValue()) : null"
    ogTitle="Conversion scan results for {{ $quickScan->domain }} via marcmcdougall.com"
    ogDescription="Is your website optimized for converions?" >
    {{-- Todo: Hide SEO metadata (robots.txt) --}}
    <div class="container">
        <article class="quick-scan" data-scan-id="{{ $quickScan->id }}">
            <div class="row">
                <div class="col-12">
                    <livewire:quick-scan-report :quickScan="$quickScan"></livewire:quick-scan-report>
                    <div class="quick-scan__cta bg--gray padded rounded row vcenter margin-top--lg margin-bottom--lg">
                        <div class="col-7">
                            <h2 class="h3 strip--mt">Want to review with a conversion expert?</h2>  
                            <p class="">I'm always down to meet new folk.  Feel free to snag 20 minutes with me to break the proverbial ice.</p>
                            <div class="button-group">
                                <div class="button-wrap" x-data>
                                    <div class="glimmer-container glimmer-container--light">
                                        <span class="blob"></span>
                                        <a href="#" 
                                            x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                                            class="btn btn--secondary">
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
                            </div>
                            <p class="newsletter-opt-in__aside margin-top--xxs margin-bottom--strip">Limited availability. 100% corny joke guarantee.</p>
                        </div>
                        <div class="col-5">
                            <x-testimonials :limit="1" :showPhoto="true" :showRole="true" type="teardown"></x-testimonials>
                        </div>
                    </div>
                </div>
            </div>
        </article>
</x-base>