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
            </ul>
        </div>
        <div class="nav__section nav__section--right">
            <a href=""
                class="nav__theme-toggler"
                title="Toggle theme"
                x-data="{ theme: localStorage.getItem('theme') || 'light' ,
                playClickOn() {
                        const audio = new Audio('sound/switch-on.wav');
                        audio.volume = 0.05; // 10% volume
                        audio.play(); 
                },
                playClickOff() {
                        const audio = new Audio('sound/switch-off.wav');
                        audio.volume = 0.05; // 10% volume
                        audio.play(); 
                }}"
                x-on:click.prevent="
                    theme = theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', theme);
                    document.documentElement.setAttribute('data-theme', theme);
                    theme === 'light' ? playClickOff() : playClickOn();">
                <svg x-bind:class="{ 'active': ('light' === theme) }"  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M16 4.5V4" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 23C19.866 23 23 19.866 23 16C23 12.134 19.866 9 16 9C12.134 9 9 12.134 9 16C9 19.866 12.134 23 16 23Z" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 7.5L7 7" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 24.5L7 25" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 7.5L25 7" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 24.5L25 25" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 16H4" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 27.5V28" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M27.5 16H28" stroke="#2C2C31" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg x-bind:class="{ 'active': ('dark' === theme) }" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.98 5.85498C13.4692 7.54505 13.4265 9.34202 13.8563 11.0545C14.2862 12.7669 15.1726 14.3306 16.421 15.5791C17.6695 16.8275 19.2332 17.7139 20.9457 18.1438C22.6581 18.5736 24.4551 18.5309 26.1451 18.0201C25.6552 19.6311 24.7563 21.0877 23.5362 22.2482C22.316 23.4086 20.8162 24.2332 19.1826 24.6418C17.5491 25.0503 15.8376 25.0288 14.2149 24.5794C12.5921 24.13 11.1134 23.268 9.92273 22.0774C8.73207 20.8867 7.87007 19.408 7.42067 17.7852C6.97128 16.1625 6.94981 14.451 7.35835 12.8175C7.7669 11.1839 8.59154 9.68406 9.75195 8.46392C10.9124 7.24377 12.369 6.34494 13.98 5.85498Z" stroke="#2C2C31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
            
            <div class="button-wrap" x-data>
                <a href="#" 
                    x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                    class="btn btn--tertiary mobile-only--nav">
                        Let's Talk
                </a>
            </div>

            <a href="#" class="nav__toggle mobile-only--nav" x-on:click.prevent="mobileMenuOpen = !mobileMenuOpen;" >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M2.5 10H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 5H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 15H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="mobile-menu" x-show="mobileMenuOpen" x-cloak x-on:click.outside="mobileMenuOpen = false" >
            <a href="#" class="mobile-menu__close" x-on:click="mobileMenuOpen = false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" fill="none">
                    <path d="M15.8337 10H4.16699" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.0003 15.8334L4.16699 10.0001L10.0003 4.16675" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
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