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
            <ul class="nav__items">
                <li class="nav__item">
                    <a class="btn btn--tertiary" href="{{ route('resources.free-course') }}">Free Course</a>
                </li>
                <li class="nav__item">
                    <a class="btn btn--secondary" href="{{ route('index') }}">Let's Talk</a>
                </li>
            </ul>
            
            <a class="btn btn--tertiary mobile-only--nav" href="{{ route('index') }}">Let's Talk</a>

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
                    <a class="btn btn--tertiary btn--large" href="{{ route('resources.free-course') }}">Free Course</a>
                    <a class="btn btn--secondary btn--large" href="{{ route('index') }}">Let's Talk</a>
                </div>
            </div>
        </div>
        <div class="mobile-menu__occluder" x-show="mobileMenuOpen"></div>
    </nav>
</header>