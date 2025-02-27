<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4 class="footer__callout">Software looks better when it's moving up and to the right.</h4>
            </div>
            <div class="footer__nav footer__nav--first">
                <p class="footer__nav__title">Resources</p>
                <ul class="normalize-list">
                    <li>
                        <a href="{{ route('articles.index') }}">Articles</a>
                    </li>
                    <li>
                        <a href="{{ route('podcast-appearances.index') }}">Podcast Appearances</a>
                    </li>
                    <li>
                        <a href="{{ route('resources.clarity-call') }}">Clarity Call</a>
                    </li>
                    <li>
                        <a href="{{ route('resources.teardown') }}">Page Teardown</a>
                    </li>
                </ul>
            </div>
            <div class="footer__nav">
                <p class="footer__nav__title">Company</p>
                <ul class="normalize-list">
                    <li>
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li>
                        <a href="https://dribbble.com/marcmcdougall" target="_blank">Portfolio</a>
                    </li>
                    <li>
                        <a href="{{ route('testimonials.index') }}">Testimonials</a>
                    </li>
                    {{-- <li>
                        <a href="#" 
                            x-on:click.prevent="Calendly.initPopupWidget({url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'});return false;">
                            Let's Talk
                        </a>
                    </li> --}}
                </ul>
                </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="separator">
                    <span class="separator__line"></span>
                </div>
            </div>
        </div>

        <div class="row copyright">
            <div class="col-6 mobile--bottom">
                <p>&copy; {{ now()->year }} Kilobyte Studios, LLC.  All rights reserved.</p>
            </div>
            <div class="col-6 align--right">
                <p><a href="#">Built with Function.al</a></p>
            </div>
        </div>
    </div>
</footer>