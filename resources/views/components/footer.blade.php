<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4 class="footer__callout">Software looks better when it's moving up and to the right.</h4>
            </div>
            <div class="footer__nav footer__nav--first">
                <p class="footer__nav__title">About</p>
                <ul class="normalize-list">
                    <li>
                        <a href="#">Story</a>
                    </li>
                    <li>
                        <a href="#">Process</a>
                    </li>
                    <li>
                        <a href="{{ route('podcast-appearances.index') }}">Podcast Appearances</a>
                    </li>
                </ul>
            </div>
            <div class="footer__nav">
                <p class="footer__nav__title">Company</p>
                <ul class="normalize-list">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">Testimonials</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
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