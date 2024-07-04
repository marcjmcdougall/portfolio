<div class="testimonial" data-type="{{ $testimonial->type[0] }}">
    <div class="testimonial__text">
        <p class="testimonial__content">"{{ $testimonial->content }}"</p>
        <div class="testimonial__source">
            @if( ($showPhoto ?? false) )
                @isset( $testimonial->profile_photo )
                    <div class="testimonials__profile-photo"
                        style="background-image: url({{ asset( 'storage/' . $testimonial->profile_photo ) }})">
                        <img class="sr-only" src="{{ asset( 'storage/' . $testimonial->profile_photo ) }}" />
                    </div>
                @endisset
            @endif
            <div class="testimonial__source__text">
                <p class="testimonial__attribution">{{ $testimonial->name }}</p>
                @if( ($showRole ?? false) )
                    <p class="testimonial__role">{{ $testimonial->role }}</p>
                @endif
            </div>
        </div>
    </div>
</div>