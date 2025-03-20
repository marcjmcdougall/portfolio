<x-base
    hideNewsletter
    title="Marc McDougall – Quick scan for {{ $quickScan->url }}"
    trackEvent="quick-scan generated">
    {{-- Todo: Hide SEO metadata (robots.txt) --}}
    <div class="container">
        <article class="quick-scan">
            {{-- <pre>
            @php
                print_r($quickScan->info['openai_messaging_evaluation']);
            @endphp
            </pre> --}}
            <div class="row">
                <div class="col-12">
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
                        @isset($quickScan->screenshot_path)
                            <div class="quick-scan__thumbnail lazy-bg" data-bg="{{ asset( 'storage/' . $quickScan->screenshot_path ) }}" >
                                <img class="sr-only" alt="A screenshot of {{ $quickScan->url }}" />
                            </div>
                        @else
                            {{-- <div class="quick-scan__thumbnail--placeholder"></div> --}}
                            <x-loading classes="quick-scan__thumbnail--placeholder"></x-loading>
                        @endisset
                    </div>

                    <header class="quick-scan__header">
                        <div class="quick-scan__header__left">
                            <p class="margin-top--strip margin-bottom--strip">CRO QuickScan<span class="superscript">™</span> for &hellip;</p>
                            <h1 class="h2 quick-scan__header__title margin-top--strip">{{ preg_replace('/^https?:\/\/(www\.)?/', '', $quickScan->url) }}</h1>
                        </div>
                        <div class="quick-scan__header__right">
                            <div class="quick-scan__header__status">
                                <div class="quick-scan__header__status__overview">
                                    Processing 
                                    <span class="quick-scan__header__status__progress">{{ $quickScan->progress }}%</span>
                                </div>
                                <div class="quick-scan__header__status__progress-bar">
                                    <div class="quick-scan__header__status__progress-bar__progress" style="width: 20%;"></div>
                                </div>
                                <div class="quick-scan__header__status__details">
                                    Evaluating text &hellip;
                                </div>
                            </div>
                            {{-- <a class="btn btn--tertiary btn--icon link--external" href="{{ $quickScan->url }}" target="_blank">
                                Visit Site
                            </a> --}}
                            {{-- <a class="btn btn--secondary" href="#">Download</a> --}}
                        </div>
                    </header>

                    <div class="quick-scan__sections">
                        <div class="quick-scan__section">
                            <h2 class="quick-scan__section__header h4 margin-top--strip">Overview</h2>
                            @if($categories)
                                <p>{{ $categories['meta']['sections']['overall']['analysis'] }}</p>
                                @isset($categories['meta']['sections']['overall']['takeaway'])
                                    <p>{{ $categories['meta']['sections']['overall']['takeaway'] }}</p>
                                @endisset
                            @else
                                <x-loading></x-loading>
                            @endif
                            <div class="quick-scan__section__statistics">
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Conversion Chance</p>
                                    @if('' != $categories['meta']['sections']['conversionChance']['responseOptions'])
                                        <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">{{ $categories['meta']['sections']['conversionChance']['responseOptions'] }} <span class="grade grade--sm grade--{{ strtolower($categories['meta']['sections']['conversionChance']['grade']) }}">{{ $categories['meta']['sections']['conversionChance']['grade'] }}</span></p>
                                    @else
                                        <x-loading></x-loading>
                                    @endif
                                </div>
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Messaging</p>
                                    @if('' != $categories['meta']['sections']['messaging']['responseOptions'])
                                        <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">{{ $categories['meta']['sections']['messaging']['responseOptions'] }} <span class="grade grade--sm grade--{{ strtolower($categories['meta']['sections']['messaging']['grade']) }}">{{ $categories['meta']['sections']['messaging']['grade'] }}</span></p>
                                    @else
                                        <x-loading :delay="2"></x-loading>
                                    @endif
                                </div>
                                <div class="quick-scan__section__statistic">
                                    <p class="quick-scan__section__statistic__label margin-top--strip margin-bottom--strip">Perceived Load Time</p>
                                    @if($performanceMetrics)
                                        <p class="quick-scan__section__statistic__value margin-top--strip margin-bottom--strip">{{ $performanceMetrics['lcp'] }}s <span class="grade grade--sm grade--{{ strtolower($performanceMetrics['grade']) }}">{{ $performanceMetrics['grade'] }}</span></p>
                                    @else
                                        <x-loading :delay="4"></x-loading>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($categories)
                            @foreach($categories as $categoryKey => $category)
                                @if(
                                    'meta' != $categoryKey &&
                                    'other' != $categoryKey
                                    )
                                    <div class="quick-scan__section">
                                        <h2 class="quick-scan__section__header h4 margin-top--strip">{{ $category['title'] }}</h2>
                                        
                                        <div class="quick-scan__subsections">
                                            @foreach($category['sections'] as $sectionKey => $section)
                                                <div class="quick-scan__subsection">
                                                    <div class="quick-scan__subsection__header">
                                                        <h3 class="h5 margin-top--strip margin-bottom--strip">{{ $section['title'] }}</h3>
                                                        <div class="quick-scan__subsection__header__grade">
                                                            {{ $section['rating'] }}
                                                            <span class="grade grade--sm grade--{{ strtolower($section['grade']) }}">{{ $section['grade'] }}</span>
                                                        </div>
                                                    </div>
                                                    @if( null != $section['analysis'])
                                                        <p>{{ $section['analysis'] }}</p>
                                                    @else
                                                        <x-loading classes="loading--large"></x-loading>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
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
        </div>
</x-base>