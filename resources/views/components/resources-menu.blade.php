<li class="nav__item nav__item--has-children" x-data="{ open: false }" x-bind:class="open ? 'open' : ''">
    <a href="#" x-on:click.prevent="$event.stopPropagation(); open = !open">Resources</a>
    <div class="nav__submenu" x-cloak x-on:click.outside="if(!$event.target.closest('a')); open = false">
        <div class="nav__submenu__section">
            <label class="section-label">Free Stuff</label>
            <ul class="nav__items">
                <li class="nav__item">
                    <a href="{{ route('articles.index') }}">Articles</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('podcast-appearances.index') }}">Podcast Appearances</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('resources.free-course') }}"><span class="badge">New</span> <span class="desktop-only">10-Day</span> Design Course</a>
                </li>
                <li class="nav__item">
                    <a class="link--external" target="_blank" rel="noreferrer" href="https://www.youtube.com/@DemystifyingDesign">Demystifying Design</a>
                </li>
            </ul>
        </div>
        <div class="nav__submenu__section">
            <label class="section-label">Paid Stuff</label>
            <ul class="nav__items">
                <li class="nav__item nav__item--block">
                    <a href="{{ route('resources.clarity-call') }}">
                        <span class="icon__wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                <path d="M21 12C21.0034 13.3199 20.6951 14.6219 20.1 15.8C19.3944 17.2117 18.3098 18.3992 16.9674 19.2293C15.6251 20.0594 14.0782 20.4994 12.5 20.5C11.1801 20.5034 9.87812 20.1951 8.7 19.6L3 21.5L4.9 15.8C4.30493 14.6219 3.99656 13.3199 4 12C4.00061 10.4218 4.44061 8.87485 5.27072 7.53255C6.10083 6.19025 7.28825 5.10557 8.7 4.4C9.87812 3.80493 11.1801 3.49656 12.5 3.5H13C15.0843 3.61499 17.053 4.49476 18.5291 5.97086C20.0052 7.44695 20.885 9.41565 21 11.5V12Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="nav__item--block__text">
                            <p class="nav__item--block__title margin-top--strip margin-bottom--strip">Clarity Call</p>
                            <p class="nav__item--block__description margin-top--strip margin-bottom--strip">Talk to a design expert</p>
                        </div>
                    </a>
                </li>
                <li class="nav__item nav__item--block">
                    <a href="{{ route('resources.teardown') }}">
                        <span class="icon__wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 12H20.25" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6H20.25" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18H20.25" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3.75 6L5.25 7.5L8.25 4.5" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3.75 12L5.25 13.5L8.25 10.5" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3.75 18L5.25 19.5L8.25 16.5" stroke="#3A84F3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="nav__item--block__text">
                            <p class="nav__item--block__title margin-top--strip margin-bottom--strip">Page Teardown</p>
                            <p class="nav__item--block__description margin-top--strip margin-bottom--strip">Get insights on a landing page</p>
                        </div>
                    </a>
                </li>
                <li class="nav__item nav__item--block">
                    <a href="{{ route('resources.functional') }}">
                        <span class="icon__wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                <g clip-path="url(#clip0_877_733)">
                                    <path d="M5 6C5 5.07174 5.36875 4.1815 6.02513 3.52513C6.6815 2.86875 7.57174 2.5 8.5 2.5H12V9.5H8.5C7.57174 9.5 6.6815 9.13125 6.02513 8.47487C5.36875 7.8185 5 6.92826 5 6Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 2.5H15.5C15.9596 2.5 16.4148 2.59053 16.8394 2.76642C17.264 2.94231 17.6499 3.20012 17.9749 3.52513C18.2999 3.85013 18.5577 4.23597 18.7336 4.66061C18.9095 5.08525 19 5.54037 19 6C19 6.45963 18.9095 6.91475 18.7336 7.33939C18.5577 7.76403 18.2999 8.14987 17.9749 8.47487C17.6499 8.79988 17.264 9.05769 16.8394 9.23358C16.4148 9.40947 15.9596 9.5 15.5 9.5H12V2.5Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 13C12 12.5404 12.0905 12.0852 12.2664 11.6606C12.4423 11.236 12.7001 10.8501 13.0251 10.5251C13.3501 10.2001 13.736 9.94231 14.1606 9.76642C14.5852 9.59053 15.0404 9.5 15.5 9.5C15.9596 9.5 16.4148 9.59053 16.8394 9.76642C17.264 9.94231 17.6499 10.2001 17.9749 10.5251C18.2999 10.8501 18.5577 11.236 18.7336 11.6606C18.9095 12.0852 19 12.5404 19 13C19 13.4596 18.9095 13.9148 18.7336 14.3394C18.5577 14.764 18.2999 15.1499 17.9749 15.4749C17.6499 15.7999 17.264 16.0577 16.8394 16.2336C16.4148 16.4095 15.9596 16.5 15.5 16.5C15.0404 16.5 14.5852 16.4095 14.1606 16.2336C13.736 16.0577 13.3501 15.7999 13.0251 15.4749C12.7001 15.1499 12.4423 14.764 12.2664 14.3394C12.0905 13.9148 12 13.4596 12 13Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 20C5 19.0717 5.36875 18.1815 6.02513 17.5251C6.6815 16.8687 7.57174 16.5 8.5 16.5H12V20C12 20.9283 11.6313 21.8185 10.9749 22.4749C10.3185 23.1313 9.42826 23.5 8.5 23.5C7.57174 23.5 6.6815 23.1313 6.02513 22.4749C5.36875 21.8185 5 20.9283 5 20Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 13C5 12.0717 5.36875 11.1815 6.02513 10.5251C6.6815 9.86875 7.57174 9.5 8.5 9.5H12V16.5H8.5C7.57174 16.5 6.6815 16.1313 6.02513 15.4749C5.36875 14.8185 5 13.9283 5 13Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_877_733">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <div class="nav__item--block__text">
                            <p class="nav__item--block__title margin-top--strip margin-bottom--strip">UI Design System</p>
                            <p class="nav__item--block__description margin-top--strip margin-bottom--strip">Build intuitive interfaces fast</p>
                        </div>
                    </a>
                </li>
                <li class="nav__item nav__item--block">
                    <a href="{{ route('resources.functional') }}">
                        <span class="icon__wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M4.5 20.25C4.5 19.6533 4.73705 19.081 5.15901 18.659C5.58097 18.2371 6.15326 18 6.75 18H19.5V3H6.75C6.15326 3 5.58097 3.23705 5.15901 3.65901C4.73705 4.08097 4.5 4.65326 4.5 5.25V20.25Z" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.5 20.25V21H18" stroke="#3A84F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div class="nav__item--block__text">
                            <p class="nav__item--block__title margin-top--strip margin-bottom--strip">Learn UI Design</p>
                            <p class="nav__item--block__description margin-top--strip margin-bottom--strip">All my design tips & tricks</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</li>