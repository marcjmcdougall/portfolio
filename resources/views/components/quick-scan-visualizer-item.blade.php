<div class="quick-scan-visualizer__item has-animation" style="transition-delay: {{ $delay ?? 0 }}s;">
    <div class="quick-scan-visualizer__item__text">
        <p class="quick-scan-visualizer__item__text__header margin-top--strip">{{ $header }}</p>
        <p class="quick-scan-visualizer__item__text__body margin-top--strip margin-bottom--strip">{{ $body }}</p>
    </div>
    <span class="quick-scan-visualizer__item__grade grade grade--sm grade--{{ strtolower($grade) }}">{{ $grade }}</span>
</div>