<div 
    {{-- Only poll if needed --}}
    @if($shouldPoll) wire:poll.2s @endif >
    {{-- @php
        print_r($quickScan)
    @endphp --}}
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
            <div class="quick-scan__thumbnail" style="background-image:url('{{ asset( 'storage/' . $quickScan->screenshot_path ) }}')" >
                <img class="sr-only" alt="A screenshot of {{ $quickScan->url }}" />
            </div>
        @else
            {{-- <div class="quick-scan__thumbnail--placeholder"></div> --}}
            <x-loading classes="quick-scan__thumbnail--placeholder"></x-loading>
        @endisset
    </div>

    <header class="quick-scan__header">
        <div class="quick-scan__header__left">
            <p class="margin-top--strip margin-bottom--strip text--large">CRO QuickScan<span class="superscript">™</span> for &hellip;</p>
            <h1 class="h2 quick-scan__header__title margin-top--strip margin-bottom--strip">{{ $readableURL }}</h1>
        </div>
        <div class="quick-scan__header__right">
            @if('processing' === $quickScan->status ||
                'queued' === $quickScan->status)
                <div class="quick-scan__header__status">
                    Started {{ $quickScan->created_at->diffForHumans() }}
                </div>
            @else
                <div class="quick-scan__header__status quick-scan__header__status--complete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8.25 12.75L10.5 15L15.75 9.75" stroke="#00CC66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#00CC66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Done
                </div>
            @endif
            {{-- <a class="btn btn--tertiary btn--icon link--external" href="{{ $quickScan->url }}" target="_blank">
                Visit Site
            </a> --}}
            {{-- <a class="btn btn--secondary" href="#">Download</a> --}}
        </div>
    </header>

    <div class="quick-scan__header__meta">
        <div class="quick-scan__header__meta__item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.125 10C13.125 15 10 17.5 10 17.5C10 17.5 6.875 15 6.875 10C6.875 5 10 2.5 10 2.5C10 2.5 13.125 5 13.125 10Z" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.92676 7.5H17.0736" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.92676 12.5H17.0736" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <a href="{{ $quickScan->url }}" target="_blank" rel="noopener">{{ $quickScan->url }}</a>
        </div>
        <div class="quick-scan__header__meta__item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 10C13.797 10 16.875 8.32107 16.875 6.25C16.875 4.17893 13.797 2.5 10 2.5C6.20304 2.5 3.125 4.17893 3.125 6.25C3.125 8.32107 6.20304 10 10 10Z" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3.125 6.25V10C3.125 12.0711 6.20313 13.75 10 13.75C13.7969 13.75 16.875 12.0711 16.875 10V6.25" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3.125 10V13.75C3.125 15.8211 6.20313 17.5 10 17.5C13.7969 17.5 16.875 15.8211 16.875 13.75V10" stroke="#020202" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            @isset($quickScan->info['html_size_kb'])
                {{ $quickScan->info['html_size_kb'] }} KB
            @else
                <x-loading></x-loading>
            @endisset
        </div>
    </div>

    @if( ! $completeOnLoad )
        <div class="quick-scan__status" data-load="{{ $completeOnLoad }}">
            <div class="quick-scan__status__overview">
                @if('processing' === $quickScan->status)
                    Processing &hellip;
                @elseif('completed' === $quickScan->status)
                    Complete
                @endif
                <span class="quick-scan__status__progress"><span class="quick-scan__status__progress__counter count-up" data-count="{{ $quickScan->progress ?? 0}}">{{ $quickScan->progress ?? 0 }}</span>%</span>
            </div>
            <div class="quick-scan__status__progress-bar">
                <div class="quick-scan__status__progress-bar__progress" style="width: {{ $quickScan->progress }}%;"></div>
            </div>
            <div class="quick-scan__status__details">
                Most scans take 2-3 mins.  We'll email you when it's done.
            </div>
        </div>
    @endif

    <div class="quick-scan__sections">
        <div class="quick-scan__section">
            <h2 class="quick-scan__section__header h4 margin-top--strip">Overview</h2>
            @if('' != $categories['meta']['sections']['overall']['analysis'])
                <p>{{ $categories['meta']['sections']['overall']['analysis'] }}</p>
                @isset($categories['meta']['sections']['overall']['takeaway'])
                    <p>{{ $categories['meta']['sections']['overall']['takeaway'] }}</p>
                @endisset
            @else
                <x-loading classes="loading--large"></x-loading>
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
                    @if(null != $performanceMetrics)
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
</div>