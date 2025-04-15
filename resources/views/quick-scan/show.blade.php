<x-base
    hideNewsletter
    :ogImage="$quickScan->screenshot_path->isSuccess() ? asset('storage/' . $quickScan->screenshot_path->getValue()) : null"
{{-- 
    @if($quickScan->screenshot_path->isSuccess())
        ogImage="{{ asset( 'storage/' . $quickScan->screenshot_path->getValue() ) }}"
    @endif --}}
    title="Quick scan for {{ $quickScan->url }} – Marc McDougall" >
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
                                                Free Discovery Call
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