<div class="quick-scan-report-visualizer">
    <div class="quick-scan-report-visualizer__reports__occluder quick-scan-report-visualizer__reports__occluder--left"></div>
    <div class="quick-scan-report-visualizer__reports">
        @for ($index = 0; $index < 5; $index++)
            <x-quick-scan-report-visualizer-item count="{{ $index }}"></x-quick-scan-report-visualizer-item>
        @endfor
        @for ($index = 0; $index < 5; $index++)
            <x-quick-scan-report-visualizer-item count="{{ $index }}"></x-quick-scan-report-visualizer-item>
        @endfor
    </div>
    <div class="quick-scan-report-visualizer__reports__occluder quick-scan-report-visualizer__reports__occluder--right"></div>
</div>