<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-ready="false">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @vite('resources/js/theme-init.js')

        <!-- Title and Description -->
        <title>{{ $title ?? config('metadata.defaults.title') }}</title>
        <meta name="description" content="{{ $description ?? config('metadata.defaults.description') }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="{{ $ogType ?? 'website' }}">
        <meta property="og:url" content="{{ $canonicalUrl ?? url()->current() }}">
        <meta property="og:title" content="{{ $ogTitle ?? $ogTitle ?? config('metadata.defaults.title') }}">
        <meta property="og:description" content="{{ $ogDescription ?? $ogDescription ?? config('metadata.defaults.description') }}">
        <meta property="og:image" content="{{ $ogImage ?? asset(config('metadata.defaults.og_image')) }}">

        @if(config('metadata.social.facebook.app_id'))
            <meta property="fb:app_id" content="{{ config('metadata.social.facebook.app_id') }}">
        @endif
        
        @if(config('metadata.social.facebook.admin_id'))
            <meta property="fb:admins" content="{{ config('metadata.social.facebook.admin_id') }}">
        @endif

        <!-- Twitter -->
        <meta name="twitter:card" content="{{ $twitterCard ?? config('metadata.social.twitter.card') }}">
        <meta name="twitter:url" content="{{ $canonicalUrl ?? url()->current() }}">
        <meta name="twitter:title" content="{{ $twitterTitle ?? $ogTitle ?? $title ?? config('metadata.defaults.title') }}">
        <meta name="twitter:description" content="{{ $twitterDescription ?? $ogDescription ?? $description ?? config('metadata.defaults.description') }}">
        <meta name="twitter:image" content="{{ $twitterImage ?? $ogImage ?? asset(config('metadata.defaults.og_image')) }}">
        <meta name="twitter:site" content="{{ config('metadata.social.twitter.site') }}">

        <!-- Author information -->
        <meta name="author" content="{{ $author ?? config('metadata.defaults.author') }}">

        {{-- Keywords --}}
        <meta name="keywords" content="{{ $keywords ?? config('metadata.defaults.keywords') }}">

        <!-- Custom Metadata -->
        @isset($metadata)
            @foreach($metadata as $name => $content)
                <meta name="{{ $name }}" content="{{ $content }}">
            @endforeach
        @endisset

        {{-- Fathom Analytics --}}
        <script src="https://cdn.usefathom.com/script.js" data-site="AKEJUYRB" defer></script>

        @isset($reCaptcha)
            {{-- ReCaptcha --}}
            {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}
        @endisset

        @isset($trackEvent)
            <script>
                window.addEventListener('load', (event) => {
                    if (typeof fathom !== 'undefined' && fathom) {
                        fathom.trackEvent('{{ $trackEvent }}');
                    }
                });
            </script>
        @endisset

        {{-- Plus Jakarta Sans & Afacad Flux --}}
        @googlefonts

        {{-- External Styles --}}
        {{-- <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet"> --}}

        {{-- Styles --}}
        @vite(['resources/css/index.css'])
        @livewireStyles
    </head>
    <body class="antialiased {{ $bodyClass ?? '' }}">
        <main class="content"
            {{-- style="background: radial-gradient(27.89% 37.26% at 18.28% 30.1%, rgba(255, 255, 255, 0.00) 0%, #FFF 100%), url({{asset('/img/dots-bg--tile.png')}}) lightgray 0% 0% / 50px 50px repeat;" --}}
            {{-- data-bg="{{asset('img/dots-bg--gradient.png')}}" --}}
            >
            <div class="flair lazy-bg do-animation"
                data-bg="{{asset('img/dots-bg-gradient--light.png')}}"
                style="
                background-repeat: no-repeat;
                background-position: top left;
                background-size: 100%;" >
            </div>
            <x-navigation></x-navigation>
            {{ $slot }}

            @if( ! ( $hideNewsletter ?? false ) )
                <x-newsletter-opt-in />
            @endif

            @if (session('success'))
                <div class="toast toast--success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" fill="none">
                        <path d="M6.875 10.625L8.75 12.5L13.125 8.125" stroke="#00CC66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z" stroke="#00CC66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
        </main>

        <x-footer></x-footer>

        {{-- External Scripts --}}
        {{-- External JavaScript (deferred) --}}
        {{-- <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" defer></script> --}}

        {{-- Scripts --}}
        @vite(['resources/js/app.js'])
        @livewireScripts
    </body>
</html>
