<div class="page-header">
    <div class="page-header__text">
        <h1 class="page-header__title">
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