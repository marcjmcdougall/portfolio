@props([
    'animated' => false,
    'marginTop' => '40',
    ])

<section class="brands-list brands-list--{{ ($animated ?? false) ? 'animated' : 'static'}}"
    style="margin-top: {{ $marginTop }}px">
    <div class="brands-list__occluder brands-list__occluder--left"></div>
    <div class="brands-list__wrapper">
        @foreach( $brands as $brand )
            {{-- <div class="brands-list__item" src="background-image: url( 'storage/{{ $brand->image }}' )"></div> --}}
            <img class="brands-list__item {{ $animated ? '' : 'lazy' }}" data-created-at="{{ $brand->created_at }}" alt="{{ $brand->name }} logo" data-src="/storage/{{ $brand->image }}"/>
        @endforeach

        {{-- Output twice for animation --}}
        @foreach( $brands as $brand )
            {{-- <div class="brands-list__item" src="background-image: url( 'storage/{{ $brand->image }}' )"></div> --}}
            <img class="brands-list__item brands-list__item--extra {{ $animated ? '' : 'lazy' }}" data-created-at="{{ $brand->created_at }}" alt="{{ $brand->name }} logo" data-src="/storage/{{ $brand->image }}"/>
        @endforeach
    </div>
    <div class="brands-list__occluder brands-list__occluder--right"></div>
</section>