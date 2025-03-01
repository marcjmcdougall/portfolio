<header class="container content-header">
    <nav class="nav" x-data="{ mobileMenuOpen: false }" x-init="$watch('mobileMenuOpen', value => document.body.classList.toggle('no-scroll', value))" >
        <div class="nav__section nav__section--left">
            {{-- <img  src="{{ asset('favicon.ico') }}" /> --}}
            <a href="{{ route('index') }}" class="nav__logo mobile-only--nav">Marc McDougall</a>
            <ul class="nav__items">
                <li class="nav__item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <x-resources-menu />
                <li class="nav__item">
                    <a href="{{ route('testimonials.index') }}">Testimonials</a>
                </li>
                {{-- <li class="nav__item">
                    <a href="{{ route('testimonials.index') }}">Results</a>
                </li> --}}
            </ul>
        </div>
        <div class="nav__section nav__section--right">
            <a href=""
                class="nav__theme-toggler"
                title="Toggle theme"
                x-data="{ 
                    theme: document.documentElement.getAttribute('data-theme') || 'light',
                    systemControlled: !localStorage.getItem('theme'),
                    audioOn: null,
                    audioOff: null,
                    playClickOn() {
                        {{-- console.log('playing audio on', this.audioOn); --}}
                        if (this.audioOn) {
                            // Reset the audio to the start in case it was already playing
                            this.audioOn.currentTime = 0;
                            this.audioOn.play();
                        }
                    },
                    playClickOff() {
                        {{-- console.log('playing audio off', this.audioOff); --}}
                        if (this.audioOff) {
                            // Reset the audio to the start in case it was already playing
                            this.audioOff.currentTime = 0;
                            this.audioOff.play();
                        }
                    },
                    init() {
                        console.log('initializing audio now...');
                        // Initialize audio elements
                        this.audioOn = new Audio('/sound/switch-on.wav');
                        this.audioOn.volume = 0.10;
                        this.audioOn.load();
                        
                        this.audioOff = new Audio('/sound/switch-off.wav');
                        this.audioOff.volume = 0.10;
                        this.audioOff.load();
                        
                        // Watch for theme changes
                        this.$watch('theme', value => {
                            if (!this.systemControlled) {
                                localStorage.setItem('theme', value);
                            }
                        });
                        
                        // Listen for theme changes from system preference
                        window.addEventListener('themeChange', e => {
                            this.theme = e.detail.theme;
                            {{-- console.log('Theme changed: ' + e.detail.theme); --}}
                        });
                    }}"
                x-on:click.prevent="
                    systemControlled = false;
                    theme = theme === 'light' ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-theme', theme);
                    theme === 'light' ? playClickOff() : playClickOn();">
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
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M2.5 10H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 5H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 15H17.5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M3.75 12H20.25" stroke="#2C2C31" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.75 6H20.25" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.75 18H20.25" stroke="#011627" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
                    {{-- <a class="btn btn--secondary" href="{{ route('index') }}">Let's Talk</a> --}}
                    <a href="#" 
                        x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;" 
                        class="btn btn--secondary">
                            Let's Talk
                    </a>
                </div>
            </div>
        </div>
        {{-- <div class="mobile-menu__occluder" x-show="mobileMenuOpen"></div> --}}
    </nav>
</header>