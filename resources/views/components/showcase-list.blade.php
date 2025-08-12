<section class="showcase row vcenter margin-top--md margin-bottom--sm">
    <div class="showcase__occluder__wrap">
        <div class="showcase__occluder showcase__occluder--left"></div>
        <div class="showcase__occluder showcase__occluder--right"></div>
    </div>
    <div class="showcase__row">
        {{-- Loop 3 times for "endless" animation --}}
        @for($i = 0; $i < 3; $i++)
            @foreach ($row1Showcases as $showcase)
                <div class="showcase__item lazy-bg" 
                    data-bg="{{ asset( 'storage/' . $showcase->image ) }}"></div>
            @endforeach
        @endfor
    </div>
    <div class="showcase__row">
        {{-- Loop 3 times for "endless" animation --}}
        @for($i = 0; $i < 3; $i++)
            @foreach ($row2Showcases as $showcase)
                <div class="showcase__item lazy-bg" 
                    data-bg="{{ asset( 'storage/' . $showcase->image ) }}"></div>
            @endforeach
        @endfor
    </div>
</section>