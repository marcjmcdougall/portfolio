<div class="testimonials">
    @foreach ($testimonials as $testimonial)
        <x-testimonials.excerpt :testimonial="$testimonial" :showPhoto="$showPhoto" :showRole="$showRole"></x-testimonials.excerpt>
    @endforeach
</div>
