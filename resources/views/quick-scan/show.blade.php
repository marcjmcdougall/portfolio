<x-base
    hideNewsletter
    trackEvent="quick-scan generated">
    {{-- Todo: Hide SEO metadata (robots.txt) --}}
    <div class="container">
        <article class="quick-scan">
        <div class="row">
            <div class="col-12">
                <h1>Quick Scan for {{ $quickScan->url }}</h1>
                @isset($quickScan->screenshot_path)
                    <div class="lazy-wrapper">
                        <div class="quick-scan__thumbnail lazy-bg" data-bg="{{ asset( 'storage/' . $quickScan->screenshot_path ) }}" >
                            <img class="sr-only" alt="A screenshot of {{ $quickScan->url }}" />
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</x-base>