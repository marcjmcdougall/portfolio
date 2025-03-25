<x-base
    hideNewsletter
    title="Marc McDougall – Quick scan for {{ $quickScan->url }}"
    trackEvent="quick-scan generated">
    {{-- Todo: Hide SEO metadata (robots.txt) --}}
    <div class="container">
        <article class="quick-scan" data-scan-id="{{ $quickScan->id }}">
            {{-- <pre>
            @php
                print_r($quickScan->info['openai_messaging_evaluation']);
            @endphp
            </pre> --}}
            <div class="row">
                <div class="col-12">
                    <livewire:quick-scan-report :quickScan="$quickScan"></livewire:quick-scan-report>
                    <div class="bg--gray padded rounded row vcenter margin-top--lg margin-bottom--lg">
                        <div class="col-7">
                            <h2 class="h3 strip--mt">Want to review with a conversion expert?</h2>  
                            <p class="">I'm always down to meet new folk.  Feel free to snag 20 minutes with me to break the proverbial ice.</p>
                            <div class="button-group">
                                <div class="button-wrap" x-data>
                                    <div class="glimmer-container">
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

                    {{-- {{ $quickScan->info['openai_messaging_evaluation'] }} --}}

                    {{-- @isset($quickScan->info['openai_messaging_evaluation'])
                        <ul>
                            @forelse ($quickScan->info['openai_messaging_evaluation'] as $evaluation_item)
                                <li><strong>{{ $evaluation_item['label'] }} ({{ $evaluation_item['rating'] }}/100):</strong> {{ $evaluation_item['analysis'] }}</li>
                            @empty 
                                <li>No evaluation, yet</li>
                            @endforelse
                        </ul>
                    @endisset --}}
                </div>
            </div>
        </article>
</x-base>