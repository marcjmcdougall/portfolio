<section class="brands-list">
    <p>Brands:</p>
    @forelse( $brands as $brand )
        <div class="brands-list__item" style="background-image: url( 'storage/{{ $brand->image }}' )"></div>
    @empty
        <p class="subdued">(No brands)</p>
    @endforelse
</section>