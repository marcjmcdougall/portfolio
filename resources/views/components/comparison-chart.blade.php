<section class="margin-top--lg padding-bottom--sm">
    <div class="row center mobile--left">
        <div class="col-8">
            {{-- <h2 class="h3">To achieve better results, you have to try something better.</h2> --}}
            <h2 class="margin-top--strip">Exceptional results require an exceptional <span class="colorize underline">approach.</span></h2>
            <p class="body--large">Traditional employees simply don't get the same results.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="comparison-chart margin-top--sm">
                <p class="comparison-chart__scroll-callout margin-top--strip margin-bottom--strip">
                    Scroll for more
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M7.5 15L12.5 10L7.5 5" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
                <div class="comparison-chart__window">
                    <div class="comparison-chart__wrapper">
                        <div class="comparison-chart__column">
                            <div class="comparison-chart__cell comparison-chart__header">
                                <p>Criteria</p>
                            </div>

                            @foreach ($rows as $row)
                                <div class="comparison-chart__cell">
                                    <p class="margin-top--strip margin-bottom--strip">{{ $row }}</p>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($columns as $columnIndex => $columnValue)
                            <div class="comparison-chart__column comparison-chart__column--data {{ 0 === $columnIndex ? 'comparison-chart__column--emphasized' : 'comparison-chart__column' }}">
                                <div class="comparison-chart__cell comparison-chart__header">
                                    <p>{{ $columnValue }}</p>
                                </div>
                                @foreach ($rows as $rowIndex => $rowValue)
                                    <div class="comparison-chart__cell">
                                        @if ('y' === $values[$rowIndex][$columnIndex])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1072_5666)">
                                                    <path d="M18.3327 9.23333V10C18.3317 11.797 17.7498 13.5456 16.6738 14.9849C15.5978 16.4241 14.0854 17.4771 12.3621 17.9866C10.6389 18.4961 8.79707 18.4349 7.11141 17.8122C5.42575 17.1894 3.98656 16.0384 3.00848 14.5309C2.0304 13.0234 1.56584 11.2401 1.68408 9.44693C1.80232 7.6538 2.49702 5.94694 3.66458 4.58089C4.83214 3.21485 6.41 2.26282 8.16284 1.86679C9.91568 1.47076 11.7496 1.65195 13.391 2.38333" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M18.3333 3.33333L10 11.675L7.5 9.175" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1072_5666">
                                                    <rect width="20" height="20" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        @elseif ('n' === $values[$rowIndex][$columnIndex])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                <path d="M10.4993 18.3333C15.1017 18.3333 18.8327 14.6024 18.8327 10C18.8327 5.39763 15.1017 1.66667 10.4993 1.66667C5.89698 1.66667 2.16602 5.39763 2.16602 10C2.16602 14.6024 5.89698 18.3333 10.4993 18.3333Z" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13 7.5L8 12.5" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 7.5L13 12.5" stroke="#FD777E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @elseif ('?' === $values[$rowIndex][$columnIndex])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                                <path d="M10.4993 18.3333C15.1017 18.3333 18.8327 14.6024 18.8327 10C18.8327 5.39763 15.1017 1.66667 10.4993 1.66667C5.89698 1.66667 2.16602 5.39763 2.16602 10C2.16602 14.6024 5.89698 18.3333 10.4993 18.3333Z" stroke="#FECB17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.07422 7.5C8.27014 6.94306 8.65685 6.47342 9.16585 6.17428C9.67485 5.87513 10.2733 5.76578 10.8552 5.86559C11.4371 5.96541 11.9649 6.26794 12.3451 6.71961C12.7253 7.17128 12.9334 7.74294 12.9326 8.33334C12.9326 10 10.4326 10.8333 10.4326 10.8333" stroke="#FECB17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10.5 14.1667H10.5083" stroke="#FECB17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>