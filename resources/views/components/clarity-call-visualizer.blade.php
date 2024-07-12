<div class="clarity-call-visualizer" x-data="{ showVideo: true }">
    <div class="clarity-call__chat-bubbles" x-show="showVideo">
        <div class="clarity-call__chat-bubble clarity-call__chat-bubble--light has-animation">
            <p class="margin-top--strip margin-bottom--strip">Alright — let's clarify your messaging&hellip;</p>
        </div>
        <div class="clarity-call__chat-bubble clarity-call__chat-bubble--dark has-animation">
            <p class="margin-top--strip margin-bottom--strip">What do you recommend?</p>
        </div>
    </div>
    <div class="clarity-call-visualizer__partner-video-wrapper"
        style="background-image: url({{ asset('img/light-grid--alt.svg') }})">
        <video class="clarity-call-visualizer__video lazy-video" 
                data-src="{{ asset('video/partner-talking.mp4') }}"
                x-show="showVideo" 
                width="100%" 
                muted
                autoplay 
                loop>
            {{-- <source src="{{ asset('video/me-talking.mp4') }}" type="video/mp4"> --}}
            Your browser does not support the video tag.
        </video>
        <p class="clarity-call-visualizer__loading margin-top--strip margin-bottom--strip">
            <span x-show="showVideo">
                <svg class="clarity-call-visualizer__loading-spinner" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1238_5993)">
                        <path d="M9 1.5V4.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 13.5V16.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.69727 3.69751L5.81977 5.82001" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.1802 12.18L14.3027 14.3025" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.5 9H4.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.5 9H16.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.69727 14.3025L5.81977 12.18" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.1802 5.82001L14.3027 3.69751" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1238_5993">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </span>
            <span x-show="!showVideo">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1238_6002)">
                        <path d="M12 12V12.75C12 13.1478 11.842 13.5294 11.5607 13.8107C11.2794 14.092 10.8978 14.25 10.5 14.25H2.25C1.85218 14.25 1.47064 14.092 1.18934 13.8107C0.908035 13.5294 0.75 13.1478 0.75 12.75V5.25C0.75 4.85218 0.908035 4.47064 1.18934 4.18934C1.47064 3.90804 1.85218 3.75 2.25 3.75H3.75M7.995 3.75H10.5C10.8978 3.75 11.2794 3.90804 11.5607 4.18934C11.842 4.47064 12 4.85218 12 5.25V7.755L12.75 8.505L17.25 5.25V12.75" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M0.75 0.75L17.25 17.25" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1238_6002">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </span>
        </p>
    </div>
    <div class="clarity-call-visualizer__video-wrapper"
        style="background-image: url({{ asset('img/light-grid--alt.svg') }})">
        <video class="clarity-call-visualizer__video lazy-video" 
                data-src="{{ asset('video/me-talking.mp4') }}"
                x-show="showVideo"  
                width="100%" 
                muted 
                autoplay 
                loop >
            {{-- <source src="{{ asset('video/me-talking.mp4') }}" type="video/mp4"> --}}
            Your browser does not support the video tag.
        </video>
        <p class="clarity-call-visualizer__loading margin-top--strip margin-bottom--strip">
            <span x-show="showVideo">
                <svg class="clarity-call-visualizer__loading-spinner" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1238_5993)">
                        <path d="M9 1.5V4.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 13.5V16.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.69727 3.69751L5.81977 5.82001" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.1802 12.18L14.3027 14.3025" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.5 9H4.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.5 9H16.5" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.69727 14.3025L5.81977 12.18" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.1802 5.82001L14.3027 3.69751" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1238_5993">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                Connecting&hellip;
            </span>
            <span x-show="!showVideo">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1238_6002)">
                        <path d="M12 12V12.75C12 13.1478 11.842 13.5294 11.5607 13.8107C11.2794 14.092 10.8978 14.25 10.5 14.25H2.25C1.85218 14.25 1.47064 14.092 1.18934 13.8107C0.908035 13.5294 0.75 13.1478 0.75 12.75V5.25C0.75 4.85218 0.908035 4.47064 1.18934 4.18934C1.47064 3.90804 1.85218 3.75 2.25 3.75H3.75M7.995 3.75H10.5C10.8978 3.75 11.2794 3.90804 11.5607 4.18934C11.842 4.47064 12 4.85218 12 5.25V7.755L12.75 8.505L17.25 5.25V12.75" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M0.75 0.75L17.25 17.25" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1238_6002">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

                Disconnected
            </span>
        </p>
        <div class="clarity-call-visualizer__controls">
            <button class="clarity-call-visualizer__control clarity-call-visualizer__control--danger" x-on:click="showVideo = !showVideo;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1226_5924)">
                        <path d="M8.01007 9.9825C8.77121 10.7443 9.63144 11.4002 10.5676 11.9325L11.5201 10.98C11.724 10.7783 11.9814 10.6394 12.2619 10.5796C12.5424 10.5197 12.8341 10.5416 13.1026 10.6425C13.783 10.8964 14.49 11.0725 15.2101 11.1675C15.5705 11.2184 15.9001 11.3987 16.1374 11.6747C16.3748 11.9507 16.5037 12.3035 16.5001 12.6675V14.9175C16.5009 15.1264 16.4581 15.3331 16.3745 15.5245C16.2908 15.7159 16.168 15.8877 16.0141 16.0289C15.8602 16.1701 15.6785 16.2776 15.4806 16.3445C15.2828 16.4114 15.0731 16.4363 14.8651 16.4175C12.5572 16.1667 10.3403 15.3781 8.39257 14.115C7.48902 13.5413 6.65147 12.8697 5.89507 12.1125M3.89257 9.6075C2.62946 7.65975 1.84084 5.44287 1.59007 3.135C1.57133 2.9276 1.59598 2.71857 1.66245 2.52121C1.72892 2.32386 1.83575 2.14251 1.97615 1.98871C2.11654 1.83491 2.28743 1.71203 2.47792 1.62789C2.6684 1.54375 2.87433 1.50019 3.08257 1.5H5.33257C5.69655 1.49641 6.04942 1.62531 6.32539 1.86265C6.60137 2.09999 6.78163 2.42958 6.83257 2.79C6.92754 3.51005 7.10366 4.21704 7.35757 4.8975C7.45848 5.16594 7.48032 5.45768 7.4205 5.73816C7.36069 6.01863 7.22172 6.27608 7.02007 6.48L6.06757 7.4325" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.25 0.75L0.75 17.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1226_5924">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>
            <div class="clarity-call-visualizer__control">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                    <g clip-path="url(#clip0_1226_5934)">
                        <path d="M17.75 5.25L12.5 9L17.75 12.75V5.25Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 3.75H2.75C1.92157 3.75 1.25 4.42157 1.25 5.25V12.75C1.25 13.5784 1.92157 14.25 2.75 14.25H11C11.8284 14.25 12.5 13.5784 12.5 12.75V5.25C12.5 4.42157 11.8284 3.75 11 3.75Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1226_5934">
                        <rect width="18" height="18" fill="white" transform="translate(0.5)"/>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <div class="clarity-call-visualizer__control clarity-call-visualizer__control--light">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_1226_5963)">
                        <path d="M0.75 0.75L17.25 17.25" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.75 6.75V9C6.75039 9.44472 6.88256 9.87935 7.12982 10.249C7.37708 10.6186 7.72834 10.9067 8.13923 11.0769C8.55012 11.247 9.00221 11.2915 9.43841 11.2049C9.87461 11.1182 10.2753 10.9043 10.59 10.59M11.25 7.005V3C11.2506 2.44202 11.0438 1.90374 10.6698 1.48965C10.2958 1.07556 9.78128 0.815207 9.22612 0.75913C8.67097 0.703054 8.11478 0.855257 7.66554 1.18619C7.21629 1.51713 6.90604 2.00318 6.795 2.55" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.7501 12.7125C12.018 13.4598 11.0792 13.9713 10.0543 14.1814C9.02946 14.3916 7.96516 14.2907 6.99801 13.8917C6.03086 13.4928 5.20496 12.814 4.62627 11.9424C4.04758 11.0708 3.74249 10.0462 3.75014 9V7.5M14.2501 7.5V9C14.2499 9.30933 14.2223 9.61803 14.1676 9.9225" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 14.25V17.25" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 17.25H12" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1226_5963">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <div class="clarity-call-visualizer__control">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                    <path d="M3.5 9V15C3.5 15.3978 3.65804 15.7794 3.93934 16.0607C4.22064 16.342 4.60218 16.5 5 16.5H14C14.3978 16.5 14.7794 16.342 15.0607 16.0607C15.342 15.7794 15.5 15.3978 15.5 15V9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.5 4.5L9.5 1.5L6.5 4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.5 1.5V11.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="clarity-call-visualizer__control">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M9 9.75C9.41421 9.75 9.75 9.41421 9.75 9C9.75 8.58579 9.41421 8.25 9 8.25C8.58579 8.25 8.25 8.58579 8.25 9C8.25 9.41421 8.58579 9.75 9 9.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 4.5C9.41421 4.5 9.75 4.16421 9.75 3.75C9.75 3.33579 9.41421 3 9 3C8.58579 3 8.25 3.33579 8.25 3.75C8.25 4.16421 8.58579 4.5 9 4.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 15C9.41421 15 9.75 14.6642 9.75 14.25C9.75 13.8358 9.41421 13.5 9 13.5C8.58579 13.5 8.25 13.8358 8.25 14.25C8.25 14.6642 8.58579 15 9 15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>