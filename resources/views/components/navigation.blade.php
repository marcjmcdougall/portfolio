<header class="container content-header">
    <nav class="nav">
        <div class="nav__section nav__section--left">
            <ul class="nav__items">
                <li class="nav__items__item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav__items__item">
                    <a href="{{ route('index') }}">Resources</a>
                </li>
                <li class="nav__items__item">
                    <a href="{{ route('articles.index') }}">Articles</a>
                </li>
            </ul>
        </div>
        <div class="nav__section nav__section--right">
            <ul class="nav__items">
                <li class="nav__items__item">
                    <a class="btn btn--tertiary" href="{{ route('index') }}">Free Course</a>
                </li>
                <li class="nav__items__item">
                    <a class="btn btn--secondary" href="{{ route('index') }}">Let's Talk</a>
                </li>
            </ul>
        </div>
    </nav>
</header>