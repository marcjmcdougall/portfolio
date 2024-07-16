<div class="social-proof">
    <div class="social-proof__items">
        @forelse( $testimonials as $testimonial )
            <div class="social-proof__item" style="background-image: url( 'storage/{{ $testimonial->profile_photo }}' )"></div>
        @empty
            <p>(No testimonials)</p>
        @endforelse
    </div>
    <p>550+ happy customers <span class="desktop-only">and counting</span>!</p>
</div>