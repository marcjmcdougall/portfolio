<div class="newsletter-lesson {{ ( $complete ?? false ) ? 'newsletter-lesson--complete' : '' }} {{ ( $emphasized ?? false ) ? 'newsletter-lesson--emphasized' : '' }}">
    <div class="newsletter-lesson__header">
        <div class="newsletter-lesson__header__left">
            <p class="newsletter-lesson__title margin-top--strip margin-bottom--strip">{{ $title ?? 'Lesson 1' }}</p>
            @if($emphasized ?? false)
                <svg class="newsletter-lesson__strikethrough" xmlns="http://www.w3.org/2000/svg" width="427" height="193" viewBox="0 0 427 193" fill="none">
                    <path class="newsletter-lesson__strikethrough__line has-animation" d="M424.952 42.7394C415.041 41.1907 405.223 40.0429 395.189 39.4059C352.952 36.7241 310.165 36.8088 267.897 38.3582C199.235 40.875 132.469 50.8452 69.9826 80.3602C48.4392 90.5361 19.0309 103.619 5.93184 125.124C-3.38656 140.423 3.72391 157.285 17.9801 166.269C33.4015 175.987 51.6537 181.109 69.3159 184.699C104.292 191.807 141.121 193.073 176.607 189.699C211.972 186.336 246.723 178.509 280.564 167.793C310.824 158.211 341.056 145.981 365.235 124.839C378.949 112.847 392.317 98.1333 398.57 80.6936C404.983 62.8073 402.83 40.7829 387.855 27.7386C373.009 14.8064 351.867 9.13853 333.138 5.02322C320.917 2.33777 308.795 1.59448 296.375 1.59448" stroke="#3B84F3" stroke-width="3" stroke-linecap="round"/>
                </svg>
                {{-- <svg class="newsletter-lesson__strikethrough" xmlns="http://www.w3.org/2000/svg" width="493" height="117" viewBox="0 0 493 117" fill="none">
                    <path d="M337.803 2.33985C314.119 2.33985 290.436 2.33985 266.752 2.33985C200.013 2.33985 131.695 1.84527 66.0754 15.6738C46.9553 19.7032 16.1531 26.1282 5.26286 44.8657C-7.14099 66.2077 18.4775 80.4216 34.55 87.1059C57.9684 96.8452 82.7714 103.108 107.839 106.678C134.915 110.535 160.191 111.92 187.605 113.345C215.759 114.809 243.333 116.125 271.514 115.012C310.776 113.461 349.436 106.54 387.52 97.1064C416.041 90.0411 449.782 82.1795 474.572 65.1048C482.004 59.9853 492.908 50.7679 491.334 40.2941C488.251 19.7718 455.29 11.7931 439.427 8.95922C411.461 3.96325 382.387 4.14242 354.089 3.57801C334.609 3.18947 315.257 3.52838 295.801 4.05422" stroke="#3B84F3" stroke-width="3" stroke-linecap="round"/>
                </svg> --}}
            @endif
        </div>
        <span class="newsletter-lesson__checkbox {{ ( $complete ?? false ) ? 'newsletter-lesson__checkbox--complete' : '' }}">
            @if($complete ?? false)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <g opacity="1.0">
                        <path d="M13.3332 4L5.99984 11.3333L2.6665 8" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <g opacity="0.2">
                        <path d="M13.3332 4L5.99984 11.3333L2.6665 8" stroke="#1F252F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                </svg>
            @endif
        </span>
    </div>
    @if($emphasized ?? false)
        <div class="newsletter-lesson__body">
            <p class="margin-top--strip margin-bottom--strip"><small>+ Plus 12 <em>real</em> examples</small></p>
        </div>
    @endif
</div>
