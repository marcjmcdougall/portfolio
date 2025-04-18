<div class="testimonials">
    @foreach ($testimonials as $testimonial)
        <x-testimonials.excerpt :testimonial="$testimonial" :showPhoto="$showPhoto" :showRole="$showRole" :useShortContent="$useShortContent"></x-testimonials.excerpt>
    @endforeach
</div>
