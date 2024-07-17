<div class="benefit-item benefit-item--{{ ($type ?? 'positive') }} has-animation">
    <div class="benefit-item__icon">
        @if('negative' == ($type ?? 'positive'))
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M15 5L5 15" stroke="#FF5F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 5L15 15" stroke="#FF5F58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif('positive' == ($type ?? 'positive'))
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M20 6L9 17L4 12" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif('arrow' == ($type ?? 'positive'))
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M7.5 15L12.5 10L7.5 5" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @endif
    </div>
    <p class='benefit-item__text margin-top--strip margin-bottom--strip'>{{ $text ?? 'Uncertain of what will have an impact' }}</p>
</div>