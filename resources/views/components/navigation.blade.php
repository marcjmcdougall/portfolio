<header class="container content-header">
    <nav class="nav" x-data="{ mobileMenuOpen: false }" x-init="$watch('mobileMenuOpen', value => document.body.classList.toggle('no-scroll', value))" >
        <div class="nav__section nav__section--left">
            {{-- <img  src="{{ asset('favicon.ico') }}" /> --}}
            <a href="{{ route('index') }}" class="nav__logo mobile-only--nav">Marc M.</a>
            <ul class="nav__items">
                <li class="nav__item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <x-resources-menu />
                <li class="nav__item">
                    <a href="{{ route('testimonials.index') }}">Testimonials</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('testimonials.index') }}">Results</a>
                </li>
            </ul>
        </div>
        <div class="nav__section nav__section--right">
            <a href=""
                class="nav__theme-toggler"
                title="Toggle theme"
                x-data="{ theme: localStorage.getItem('theme') || 'light' ,
                    playClickOn() {
                            const audio = new Audio('/sound/switch-on.wav');
                            audio.volume = 0.10; // 10% volume
                            audio.play(); 
                    },
                    playClickOff() {
                            const audio = new Audio('/sound/switch-off.wav');
                            audio.volume = 0.10; // 10% volume
                            audio.play(); 
                    }}"
                x-on:click.prevent="
                    theme = theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', theme);
                    document.documentElement.setAttribute('data-theme', theme);
                    theme === 'light' ? playClickOff() : playClickOn();">
                {{-- <svg x-bind:class="{ 'active': ('light' === theme) }"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M16 4.5V4" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 23C19.866 23 23 19.866 23 16C23 12.134 19.866 9 16 9C12.134 9 9 12.134 9 16C9 19.866 12.134 23 16 23Z" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 7.5L7 7" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 24.5L7 25" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 7.5L25 7" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 24.5L25 25" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 16H4" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 27.5V28" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M27.5 16H28" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> --}}
                <svg x-bind:class="{ 'active': ('light' === theme) }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3.75V3" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17.25C14.8995 17.25 17.25 14.8995 17.25 12C17.25 9.10051 14.8995 6.75 12 6.75C9.10051 6.75 6.75 9.10051 6.75 12C6.75 14.8995 9.10051 17.25 12 17.25Z" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 6L5.25 5.25" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 18L5.25 18.75" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18 6L18.75 5.25" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18 18L18.75 18.75" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.75 12H3" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 20.25V21" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20.25 12H21" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{-- <svg x-bind:class="{ 'active': ('dark' === theme) }" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.98 5.85498C13.4692 7.54505 13.4265 9.34202 13.8563 11.0545C14.2862 12.7669 15.1726 14.3306 16.421 15.5791C17.6695 16.8275 19.2332 17.7139 20.9457 18.1438C22.6581 18.5736 24.4551 18.5309 26.1451 18.0201C25.6552 19.6311 24.7563 21.0877 23.5362 22.2482C22.316 23.4086 20.8162 24.2332 19.1826 24.6418C17.5491 25.0503 15.8376 25.0288 14.2149 24.5794C12.5921 24.13 11.1134 23.268 9.92273 22.0774C8.73207 20.8867 7.87007 19.408 7.42067 17.7852C6.97128 16.1625 6.94981 14.451 7.35835 12.8175C7.7669 11.1839 8.59154 9.68406 9.75195 8.46392C10.9124 7.24377 12.369 6.34494 13.98 5.85498Z" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> --}}
                {{-- <svg x-bind:class="{ 'active': ('dark' === theme) }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M10.1353 2.63525C9.66385 4.19532 9.62441 5.85406 10.0212 7.43477C10.418 9.01548 11.2362 10.4589 12.3886 11.6113C13.541 12.7637 14.9845 13.5819 16.5652 13.9787C18.1459 14.3756 19.8047 14.3361 21.3647 13.8646C20.9124 15.3517 20.0828 16.6963 18.9565 17.7674C17.8302 18.8386 16.4457 19.5998 14.9378 19.9769C13.4299 20.354 11.8501 20.3342 10.3522 19.9194C8.85423 19.5045 7.48926 18.7088 6.39019 17.6098C5.29112 16.5107 4.49543 15.1457 4.0806 13.6478C3.66577 12.1499 3.64596 10.57 4.02308 9.06216C4.4002 7.55429 5.1614 6.16979 6.23255 5.0435C7.3037 3.91721 8.64828 3.08753 10.1353 2.63525Z" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> --}}
                <svg x-bind:class="{ 'active': ('dark' === theme) }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M10.1353 2.63525C9.66385 4.19532 9.62441 5.85406 10.0212 7.43477C10.418 9.01548 11.2362 10.4589 12.3886 11.6113C13.541 12.7637 14.9845 13.5819 16.5652 13.9787C18.1459 14.3756 19.8047 14.3361 21.3647 13.8646C20.9124 15.3517 20.0828 16.6963 18.9565 17.7674C17.8302 18.8386 16.4457 19.5998 14.9378 19.9769C13.4299 20.354 11.8501 20.3342 10.3522 19.9194C8.85423 19.5045 7.48926 18.7088 6.39019 17.6098C5.29112 16.5107 4.49543 15.1457 4.0806 13.6478C3.66577 12.1499 3.64596 10.57 4.02308 9.06216C4.4002 7.55429 5.1614 6.16979 6.23255 5.0435C7.3037 3.91721 8.64828 3.08753 10.1353 2.63525Z" stroke="#2C2C31" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <ul class="nav__items">
                <li class="nav__item">
                    <a class="btn btn--tertiary" href="{{ route('resources.free-course') }}">Free Course</a>
                </li>
                <li class="nav__item">
                    <div class="button-wrap" x-data>
                        <a href="#" 
                            x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                            class="btn btn--secondary">
                                Let's Talk
                        </a>
                    </div>
                </li>
            </ul>
            
            {{-- <div class="button-wrap" x-data>
                <a href="#" 
                    x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                    class="btn btn--tertiary mobile-only--nav">
                        Let's Talk
                </a>
            </div> --}}

            <a href="#" class="nav__toggle mobile-only--nav" x-on:click.prevent="$event.stopPropagation(); mobileMenuOpen = !mobileMenuOpen;" >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M2.5 10H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 5H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 15H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="mobile-menu" x-bind:class="mobileMenuOpen ? 'active' : ''" x-cloak x-on:click.outside="mobileMenuOpen = false" >
            <div class="mobile-menu__header">
                {{-- <a href="{{ route('index') }}" class="nav__logo mobile-only--nav">Marc M.</a> --}}
                <a href="#" class="mobile-menu__close" x-on:click="mobileMenuOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18.75 5.25L5.25 18.75" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.75 18.75L5.25 5.25" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="nav__items">
                <ul class="nav__items__top normalize-list">
                    <li class="nav__item">
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('articles.index') }}">Articles</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('testimonials.index') }}">Testimonials</a>
                    </li>
                    <x-resources-menu />
                </ul>
                <div class="nav__items__buttons">
                    <a class="btn btn--tertiary" href="{{ route('resources.free-course') }}">Free Course</a>
                    <a class="btn btn--secondary" href="{{ route('index') }}">Let's Talk</a>
                </div>
            </div>
        </div>
        <div class="mobile-menu__occluder" x-show="mobileMenuOpen"></div>
    </nav>
</header>