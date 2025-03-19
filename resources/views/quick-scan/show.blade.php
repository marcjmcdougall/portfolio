<x-base
    hideNewsletter
    title="Marc McDougall – Quick scan for {{ $quickScan->url }}"
    trackEvent="quick-scan generated">
    {{-- Todo: Hide SEO metadata (robots.txt) --}}
    <div class="container">
        <article class="quick-scan">
            <div class="row">
                <div class="col-12">
                    @isset($quickScan->screenshot_path)
                        <div class="quick-scan__thumbnail-wrapper lazy-wrapper">
                            <div class="quick-scan__thumbnail__header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="6" fill="#C83A2E"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="6" fill="#D59E17"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="6" fill="#2AB525"/>
                                </svg>
                            </div>
                            <div class="quick-scan__thumbnail lazy-bg" data-bg="{{ asset( 'storage/' . $quickScan->screenshot_path ) }}" >
                                <img class="sr-only" alt="A screenshot of {{ $quickScan->url }}" />
                            </div>
                        </div>
                    @endisset

                    <header class="quick-scan__header">
                        <div class="quick-scan__header__left">
                            <p class="margin-top--strip margin-bottom--strip">CRO QuickScan<span class="superscript">™</span> for &hellip;</p>
                            <h1 class="h2 quick-scan__header__title margin-top--strip">{{ preg_replace('/^https?:\/\/(www\.)?/', '', $quickScan->url) }}</h1>
                        </div>
                        <div class="quick-scan__header__right">
                            <p class="quick-scan__header__status">
                                <svg class="loading" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 2.5V5" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.3031 4.69678L13.5352 6.46475" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.5 10H15" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.3031 15.3031L13.5352 13.5352" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 17.5V15" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.69727 15.3031L6.46523 13.5352" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.5 10H5" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.69727 4.69678L6.46523 6.46475" stroke="#BBBBBB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Processing (50%)&hellip;
                            </p>
                            {{-- <a class="btn btn--tertiary btn--icon link--external" href="{{ $quickScan->url }}" target="_blank">
                                Visit Site
                            </a> --}}
                            {{-- <a class="btn btn--secondary" href="#">Download</a> --}}
                        </div>
                    </header>

                    <div class="quick-scan__sections">
                        <div class="quick-scan__section">
                            <h2 class="quick-scan__section__header h4 margin-top--strip">Overview</h2>
                            <p>The website effectively communicates a clear value proposition by emphasizing that it designs websites aimed at converting traffic into customers. This is appealing to businesses looking to enhance their online presence and increase sales. The simplicity and focus on customer-centric design help potential clients understand the primary benefit immediately.</p>
                            <div class="quick-scan__section__statistics">
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Conversion Chance</p>
                                    <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">Very likely <span class="grade grade--sm grade--a">A</span></p>
                                </div>
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Messaging</p>
                                    <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">Clear & direct <span class="grade grade--sm grade--a">A</span></p>
                                </div>
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Perceived Load Time</p>
                                    <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">0.62s <span class="grade grade--sm grade--a">A</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="quick-scan__section">
                            <h2 class="quick-scan__section__header h4 margin-top--strip">Messaging</h2>
                            <div class="quick-scan__subsections">
                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Value Proposition</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            85
                                            <span class="grade grade--sm grade--a">A</span>
                                        </div>
                                    </div>
                                    <p>The website effectively communicates a clear value proposition by emphasizing that it designs websites aimed at converting traffic into customers. This is appealing to businesses looking to enhance their online presence and increase sales. The simplicity and focus on customer-centric design help potential clients understand the primary benefit immediately.</p>
                                </div>

                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Primary headline</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            85
                                            <span class="grade grade--sm grade--b">B</span>
                                        </div>
                                    </div>
                                    <p>The H1 element, 'I design websites that turn traffic into customers,' is clear and direct. It communicates the primary service and its outcome succinctly, which is effective in grabbing the visitor's attention. However, it could be slightly more engaging with emotional triggers to boost its impact.</p>
                                </div>
                            </div>
                        </div>
                        <div class="quick-scan__section">
                            <h2 class="quick-scan__section__header h4 margin-top--strip">Social Proof</h2>
                            <div class="quick-scan__subsections">
                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Visible Testimonials</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            0
                                            <span class="grade grade--sm grade--f">F</span>
                                        </div>
                                    </div>
                                    <p>There were no visible testimonials found on this site.</p>
                                </div>

                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Associated Brand Imagery</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            85
                                            <span class="grade grade--sm grade--b">B</span>
                                        </div>
                                    </div>
                                    <p>The H1 element, 'I design websites that turn traffic into customers,' is clear and direct. It communicates the primary service and its outcome succinctly, which is effective in grabbing the visitor's attention. However, it could be slightly more engaging with emotional triggers to boost its impact.</p>
                                </div>
                            </div>
                        </div>
                        <div class="quick-scan__section">
                            <h2 class="quick-scan__section__header h4 margin-top--strip">Critical Path</h2>
                            <div class="quick-scan__subsections">
                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Clear next step</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            85
                                            <span class="grade grade--sm grade--a">A</span>
                                        </div>
                                    </div>
                                    <p>The website effectively communicates a clear value proposition by emphasizing that it designs websites aimed at converting traffic into customers. This is appealing to businesses looking to enhance their online presence and increase sales. The simplicity and focus on customer-centric design help potential clients understand the primary benefit immediately.</p>
                                </div>

                                <div class="quick-scan__subsection">
                                    <div class="quick-scan__subsection__header">
                                        <h3 class="h5 margin-top--strip margin-bottom--strip">Perceived effort</h3>
                                        <div class="quick-scan__subsection__header__grade">
                                            85
                                            <span class="grade grade--sm grade--b">B</span>
                                        </div>
                                    </div>
                                    <p>The H1 element, 'I design websites that turn traffic into customers,' is clear and direct. It communicates the primary service and its outcome succinctly, which is effective in grabbing the visitor's attention. However, it could be slightly more engaging with emotional triggers to boost its impact.</p>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    @isset($quickScan->info['openai_messaging_evaluation'])
                        <ul>
                            @forelse ($quickScan->info['openai_messaging_evaluation'] as $evaluation_item)
                                <li><strong>{{ $evaluation_item['label'] }} ({{ $evaluation_item['rating'] }}/100):</strong> {{ $evaluation_item['analysis'] }}</li>
                            @empty 
                                <li>No evaluation, yet</li>
                            @endforelse
                        </ul>
                    @endisset
                </div>
            </div>
        </div>
</x-base>