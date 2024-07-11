<div class="newsletter-visualizer">
    <div class="newsletter-visualizer__lessons">
        <div class="newsletter-visualizer__lessons__occluder newsletter-visualizer__lessons__occluder--top {{ ( ( $theme ?? 'blue' ) == 'light' ) ? 'newsletter-visualizer__lessons__occluder--light' : '' }}"></div>
        <x-newsletter-lesson title="Day 1: Copywriting" complete="true" :theme="( $theme ?? 'blue' )"></x-newsletter-lesson>
        <x-newsletter-lesson title="Day 2: Customer discovery" complete="true" :theme="( $theme ?? 'blue' )"></x-newsletter-lesson>
        <x-newsletter-lesson title="Day 3: The visual hierarchy" emphasized="true" :theme="( $theme ?? 'blue' )"></x-newsletter-lesson>
        <x-newsletter-lesson title="Day 4: Influence principles" :theme="( $theme ?? 'blue' )"></x-newsletter-lesson>
        <x-newsletter-lesson title="Day 5: Using scarcity" :theme="( $theme ?? 'blue' )"></x-newsletter-lesson>
        {{-- <p class="margin-top--strip margin-bottom--strip">+ 7 more action-packed lessons</p> --}}
        <div class="newsletter-visualizer__lessons__occluder {{ ( ( $theme ?? 'blue' ) == 'light' ) ? 'newsletter-visualizer__lessons__occluder--light' : '' }}"></div>
    </div>
</div>