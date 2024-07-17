<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Marc McDougall — Landing page design that actually converts.</title>

        {{-- Plus Jakarta Sans --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <!-- Scripts -->

        <!-- Styles -->
        @vite(['resources/css/index.css'])
        @livewireStyles
    </head>
    <body class="antialiased {{ $bodyClass ?? '' }}">
        <main class="content">
            <x-navigation></x-navigation>
            {{ $slot }}

            @if( ! ( $hideNewsletter ?? false ) )
                <x-newsletter-opt-in />
            @endif
        </main>

        <x-footer></x-footer>

        @vite(['resources/js/app.js'])
        @livewireScripts
    </body>
</html>
