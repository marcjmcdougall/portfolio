<div class="page-header">
    <div class="page-header__text">

        @isset( $breadcrumbs )
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route( $breadcrumbs . '.index') }}">{{ ucfirst( Str::plural( $breadcrumbs ) ) }}</a>
                </li>
            </ul>
        @endisset

        <h1 class="page-header__title text--hero">
            {{ $title }}
        </h1>
        @isset( $description )
            <p class="page-header__description">
                {{ $description }}
            </p>
        @endisset
    </div>

    {{ $slot }}
</div>