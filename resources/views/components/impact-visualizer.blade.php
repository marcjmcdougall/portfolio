<div data-scale="{{ $scale ?? '1.05' }}" style="transform: scale( {{ $scale ?? '1.05' }} )"
    @class([
        'impact-visualizer',
        'impact-visualizer--comparison' => (($type ?? 'monthly') == 'comparison'),
    ])>
    <div class="impact-visualizer__graph-wrapper @if( ! ( $showStats ?? true ) ) impact-visualizer__graph-wrapper--stats-hidden @endif">
        <div class="impact-visualizer__header">
            <div class="impact-visualizer__title">
                <p class="impact-visualizer__label margin-top--strip margin-bottom--strip">{{ $graphTitle ?? 'Revenue generated' }}</p>
                <p class="impact-visualizer__value margin-top--strip margin-bottom--strip">{{ $graphValuePrefix ?? '$'}}<span class="count-up" data-count="{{ $graphValue ?? '4200069' }}">0</span></p>
            </div>
            <div class="impact-visualizer__keys">
                <div class="impact-visualizer__key">
                    <div class="impact-visualizer__swatch impact-visualizer__swatch--before"></div>
                    <p class="margin-top--strip margin-bottom--strip">Before</p>
                </div>
                <div class="impact-visualizer__key">
                    <div class="impact-visualizer__swatch impact-visualizer__swatch--after"></div>
                    <p class="margin-top--strip margin-bottom--strip">After</p>
                </div>
            </div>
        </div>

        <div class="impact-visualizer__graph">
            <div class="impact-visualizer__graph__body">
                <div @class([
                        'impact-visualizer__graph__bars',
                        'impact-visualizer__graph__bars--space-between' => (($type ?? 'monthly') == 'comparison'),
                    ])>
                    @if(($type ?? 'monthly') == 'monthly')
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                    @elseif(($type ?? 'monthly') == 'comparison')
                        <div class="impact-visualizer__graph__bar-group">
                            <div class="impact-visualizer__graph__bar has-animation"></div>
                            <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        </div>
                        <div class="impact-visualizer__graph__bar-group">
                            <div class="impact-visualizer__graph__bar has-animation"></div>
                            <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        </div>
                        <div class="impact-visualizer__graph__bar-group">
                            <div class="impact-visualizer__graph__bar has-animation"></div>
                            <div class="impact-visualizer__graph__bar impact-visualizer__graph__bar--after has-animation"></div>
                        </div>
                    @endif
                    <div class="impact-visualizer__graph__lines">
                        <div class="impact-visualizer__graph__line"></div>
                        <div class="impact-visualizer__graph__line"></div>
                        <div class="impact-visualizer__graph__line"></div>
                        <div class="impact-visualizer__graph__line"></div>
                    </div>
                </div>
            </div>
            <div @class([
                    'impact-visualizer__graph__labels',
                    'impact-visualizer__graph__labels--space-between' => (($type ?? 'monthly') == 'comparison'),
                ])>
                @if(($type ?? 'monthly') == 'monthly')
                    <p class="impact-visualizer__graph__label margin-top--strip margin-bottom--strip">{{ date('F Y', strtotime('-1 month')) }}</p>
                    <p class="impact-visualizer__graph__label margin-top--strip margin-bottom--strip">{{ date('F Y') }}</p>
                @elseif(($type ?? 'monthly') == 'comparison')
                    <p class="impact-visualizer__graph__label margin-top--strip margin-bottom--strip">Site visitors</p>
                    <p class="impact-visualizer__graph__label margin-top--strip margin-bottom--strip">Trial signups</p>
                    <p class="impact-visualizer__graph__label margin-top--strip margin-bottom--strip">Customers</p>
                @endif
            </div>
        </div>
    </div>

    @if( ($showStats ?? true) )
        <div class="impact-visualizer__stat-wrapper">
            <div class="impact-visualizer__stat-row">
                <div class="impact-visualizer__stat">
                    <p class="impact-visualizer__stat__label margin-top--strip margin-bottom--strip">Conversions</p>
                    <div class="impact-visualizer__stat__value-wrapper">
                        <p class="impact-visualizer__stat__value margin-top--strip margin-bottom--strip"><span class="count-up" data-count="14580">0</span></p>
                        <p class="impact-visualizer__stat__delta margin-top--strip margin-bottom--strip">+122%</p>
                    </div>
                </div>
                <div class="impact-visualizer__stat">
                    <p class="impact-visualizer__stat__label margin-top--strip margin-bottom--strip">Weekly active users</p>
                    <div class="impact-visualizer__stat__value-wrapper">
                        <p class="impact-visualizer__stat__value margin-top--strip margin-bottom--strip"><span class="count-up" data-count="63412">0</span></p>
                        <p class="impact-visualizer__stat__delta margin-top--strip margin-bottom--strip">+42%</p>
                    </div>
                </div>
            </div>
            <div class="impact-visualizer__stat-row">
                <div class="impact-visualizer__stat">
                    <p class="impact-visualizer__stat__label margin-top--strip margin-bottom--strip">Bounce rate</p>
                    <div class="impact-visualizer__stat__value-wrapper">
                        <p class="impact-visualizer__stat__value margin-top--strip margin-bottom--strip"><span class="count-up" data-count="25.4">0</span>%</p>
                        <p class="impact-visualizer__stat__delta margin-top--strip margin-bottom--strip">-31%</p>
                    </div>
                </div>
                <div class="impact-visualizer__stat">
                </div>
            </div>
        </div>
    @endif
</div>