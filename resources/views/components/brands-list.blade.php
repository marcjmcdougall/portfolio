<section class="brands-list">
    @foreach( $brands as $brand )
        {{-- <div class="brands-list__item" src="background-image: url( 'storage/{{ $brand->image }}' )"></div> --}}
        <img class="brands-list__item lazy" data-created-at="{{ $brand->created_at }}" alt="{{ $brand->name }} logo" data-src="/storage/{{ $brand->image }}"/>
    @endforeach
    
    {{-- Output twice for animation --}}
    @foreach( $brands as $brand )
        {{-- <div class="brands-list__item" src="background-image: url( 'storage/{{ $brand->image }}' )"></div> --}}
        <img class="brands-list__item lazy" data-created-at="{{ $brand->created_at }}" alt="{{ $brand->name }} logo" data-src="/storage/{{ $brand->image }}"/>
    @endforeach
</section>