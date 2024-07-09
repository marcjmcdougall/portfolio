<div class="statistics">
    @if( ($showHeader ?? false ) )
        <h2 class="statistics__header">Helping customers reach <span class="highlight">remarkable</span> results</h2>
    @endif
    <div class="statistics__group">
        @foreach ($statistics as $statistic)
            <div class="statistics__item">
                <h3 class="statistics__item__header h4">{{ $statistic->value }}</h3>
                <p class="statistics__item__body">{{ $statistic->label }}</p>
            </div>
        @endforeach
    </div>
</div>