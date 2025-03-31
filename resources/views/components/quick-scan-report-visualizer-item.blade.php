<div class="quick-scan-report-visualizer__report" data-count="{{ $count }}">
    <div class="quick-scan-report-visualizer__header">
        @switch($count)
            @case(0)
                <svg width="35" height="40" viewBox="0 0 35 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.4554 2.43478V0H35V22.4348C35 32.1358 27.165 40 17.5 40C8.24271 40 0.664262 32.7853 0.0413736 23.6522H0V0H5.54455V2.43478L14.901 2.43478V0H20.4455V2.43478L29.4554 2.43478ZM29.4554 22.4348V19.0202C28.8318 19.6656 28.1633 20.2785 27.4539 20.8558C25.1121 22.7615 22.3612 24.2503 19.369 25.2589C16.3764 26.2677 13.1833 26.7826 9.96797 26.7826H6.35343C8.08848 31.2608 12.425 34.4348 17.5 34.4348C24.1028 34.4348 29.4554 29.0622 29.4554 22.4348ZM15.4269 18.2435C14.3706 19.3674 13.18 20.3419 11.8852 21.1425C13.8545 20.9882 15.7827 20.5971 17.6038 19.9833C20.013 19.1712 22.1698 17.9913 23.9621 16.5329C25.7535 15.075 27.136 13.3757 28.0645 11.5515C28.6507 10.3998 29.0518 9.20727 29.2674 8H20.2671C20.0641 9.47968 19.6891 10.9319 19.1475 12.3231C18.2893 14.5274 17.0275 16.5405 15.4269 18.2435ZM5.54455 17.8146V8H14.6483C14.4948 8.78546 14.2724 9.55482 13.9832 10.2975C13.3786 11.8506 12.4962 13.2517 11.3938 14.4246C10.2918 15.5971 8.99228 16.518 7.57404 17.143C6.91535 17.4333 6.23601 17.6576 5.54455 17.8146Z" fill="#1D3AA7"></path>
                </svg>
                @break
            @case(1)
                <svg width="31" height="40" viewBox="0 0 31 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.37022 17.9534L7.16472 15.3533L1.20508 21.313C1.96866 23.1257 3.07963 24.7927 4.4967 26.2098C4.4967 26.2098 5.02042 23.4179 7.75969 21.1014C8.25191 20.6851 7.95943 19.6247 7.0998 19.4389C6.50307 19.2135 6.1838 18.5635 6.37022 17.9534Z" fill="#422520"></path>
                    <path d="M23.3078 21.848C24.0635 22.6025 24.6987 23.4457 25.2064 24.3649C25.1992 24.3284 25.1906 24.2926 25.1796 24.2582C24.6355 22.5581 24.668 21.0847 24.9935 20.2662C25.1089 19.9762 24.9719 19.6477 24.6835 19.5286L23.2392 18.9321C23.0549 18.856 22.9913 18.6271 23.1098 18.4668L23.2133 18.3267C23.5568 17.8619 23.7177 17.2871 23.6654 16.7116L23.5419 15.3533L20.1748 18.7204L23.3078 21.848Z" fill="#422520"></path>
                    <path d="M15.3534 0C13.445 0 11.5723 0.355849 9.82471 1.03053H20.8822C19.1346 0.355849 17.2618 0 15.3534 0Z" fill="#FFC212"></path>
                    <path d="M24.7422 8.18152H28.9275C29.1045 8.51669 29.2689 8.85811 29.4205 9.20505H24.509C24.6241 8.87894 24.7033 8.53626 24.7422 8.18152ZM15.5858 8.18152H1.77917C1.60216 8.51669 1.43775 8.85811 1.28613 9.20505H15.819C15.704 8.87894 15.6247 8.53626 15.5858 8.18152Z" fill="#F46520"></path>
                    <path d="M29.8251 10.2286H23.9965C23.1699 11.466 21.7606 12.2826 20.164 12.2826C18.5674 12.2826 17.1582 11.466 16.3315 10.2286H0.881565C0.30389 11.8595 0 13.5911 0 15.3533C0 17.0384 0.278201 18.6953 0.807522 20.2632L6.44113 14.6295L7.16489 13.9058L11.2563 17.9972L14.6301 14.629L15.3533 13.907L16.0765 14.629L19.4503 17.9972L23.5417 13.9058L29.899 20.2631C30.4284 18.6953 30.7066 17.0384 30.7066 15.3532C30.7066 13.5911 30.4027 11.8595 29.8251 10.2286Z" fill="#F14E23"></path>
                    <path d="M23.0221 2.05405H7.68418C7.15515 2.35904 6.64335 2.69583 6.15186 3.06367H24.5543C24.0629 2.69583 23.5511 2.35904 23.0221 2.05405Z" fill="#FCAB15"></path>
                    <path d="M24.504 6.13437H27.6294C27.8789 6.46667 28.115 6.80787 28.3359 7.1579H24.7405C24.7006 6.80309 24.6202 6.46034 24.504 6.13437ZM15.8238 6.13437H3.07708C2.82758 6.46667 2.59147 6.80787 2.37061 7.1579H15.5874C15.6273 6.80309 15.7077 6.46034 15.8238 6.13437Z" fill="#F77C1C"></path>
                    <path d="M23.0469 4.08728H25.7824C25.927 4.22116 26.0699 4.35709 26.2098 4.49693C26.4094 4.6966 26.6023 4.90165 26.7897 5.11089H23.9874C23.727 4.72405 23.4093 4.37888 23.0469 4.08728ZM17.2812 4.08728H4.92433C4.77971 4.22116 4.63679 4.35709 4.49695 4.49693C4.29735 4.6966 4.10437 4.90165 3.91699 5.11089H16.3408C16.6012 4.72405 16.9188 4.37888 17.2812 4.08728Z" fill="#F99419"></path>
                    <path d="M20.164 11.2591C22.1425 11.2591 23.7464 9.65522 23.7464 7.67671C23.7464 5.6982 22.1425 4.0943 20.164 4.0943C18.1854 4.0943 16.5815 5.6982 16.5815 7.67671C16.5815 9.65522 18.1854 11.2591 20.164 11.2591Z" fill="#FFC212"></path>
                    <path d="M19.7817 38.996H10.9247C13.7163 40.3346 16.9902 40.3346 19.7817 38.996Z" fill="#422520"></path>
                    <path d="M5.17781 28.7744C5.14433 29.11 5.12717 29.4471 5.12695 29.7841H9.80554C9.814 29.4412 9.85397 29.1036 9.92345 28.7744H5.17781Z" fill="#422520"></path>
                    <path d="M17.776 34.9018C17.0305 35.263 16.2068 35.4539 15.3532 35.4539C14.4997 35.4539 13.676 35.2629 12.9304 34.9018H6.49816C6.70195 35.2532 6.92856 35.5951 7.17784 35.9253H23.5286C23.7779 35.595 24.0045 35.2532 24.2083 34.9018H17.776Z" fill="#422520"></path>
                    <path d="M8.06198 36.9489C8.08215 36.9693 8.10173 36.9901 8.12211 37.0104C8.47465 37.3624 8.84684 37.6826 9.23463 37.9724H21.4718C21.8596 37.6826 22.2318 37.3624 22.5844 37.0104C22.6048 36.9901 22.6243 36.9693 22.6445 36.9489H8.06198Z" fill="#422520"></path>
                    <path d="M10.247 27.7508C10.5211 27.1109 10.9179 26.5226 11.4259 26.0155L15.3532 22.0948L19.2805 26.0155C19.7885 26.5226 20.1853 27.111 20.4594 27.7508H25.3737C24.9878 25.8532 24.0585 24.044 22.5844 22.5724L15.3532 15.3533L8.12211 22.5724C6.64801 24.044 5.71868 25.8533 5.3328 27.7508H10.247Z" fill="#422520"></path>
                    <path d="M20.7831 28.7744C20.8525 29.1036 20.8925 29.4412 20.9009 29.7841H25.5795C25.5793 29.4471 25.5621 29.11 25.5286 28.7744H20.7831Z" fill="#422520"></path>
                    <path d="M10.1418 31.8311C10.0203 31.5008 9.93065 31.1584 9.87442 30.8076H5.17773C5.21188 31.1506 5.26377 31.4923 5.33258 31.8311H10.1418Z" fill="#422520"></path>
                    <path d="M20.0611 32.8547C19.8411 33.2041 19.5802 33.5316 19.2805 33.8307C19.2644 33.8467 19.248 33.8624 19.2317 33.8782H24.7273C24.8739 33.5427 25.0011 33.2009 25.1099 32.8547H20.0611Z" fill="#422520"></path>
                    <path d="M20.8321 30.8076C20.7758 31.1584 20.6862 31.5009 20.5647 31.8311H25.3739C25.4428 31.4923 25.4946 31.1506 25.5288 30.8076H20.8321Z" fill="#422520"></path>
                    <path d="M11.4747 33.8783C11.4584 33.8625 11.442 33.8468 11.4259 33.8307C11.1263 33.5316 10.8654 33.2042 10.6454 32.8547H5.5965C5.70528 33.2011 5.83254 33.5428 5.97914 33.8783H11.4747Z" fill="#422520"></path>
                </svg>
                @break
            @case(2)
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 40 40">
                    <path fill="#F06225" d="M20 0c11.046 0 20 8.954 20 20v14a6 6 0 0 1-6 6H21v-8.774c0-2.002.122-4.076 1.172-5.78a10 10 0 0 1 6.904-4.627l.383-.062a.8.8 0 0 0 0-1.514l-.383-.062a10 10 0 0 1-8.257-8.257l-.062-.383a.8.8 0 0 0-1.514 0l-.062.383a9.999 9.999 0 0 1-4.627 6.904C12.85 18.878 10.776 19 8.774 19H.024C.547 8.419 9.29 0 20 0Z"></path>
                    <path fill="#F06225" d="M0 21h8.774c2.002 0 4.076.122 5.78 1.172a10.02 10.02 0 0 1 3.274 3.274C18.878 27.15 19 29.224 19 31.226V40H6a6 6 0 0 1-6-6V21ZM40 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"></path>
                </svg>
                @break
            @case(3)
                <svg id="logo-86" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd" d="M25.5557 11.6853C23.9112 10.5865 21.9778 10 20 10V0C23.9556 0 27.8224 1.17298 31.1114 3.37061C34.4004 5.56823 36.9638 8.69181 38.4776 12.3463C39.9913 16.0008 40.3874 20.0222 39.6157 23.9018C38.844 27.7814 36.9392 31.3451 34.1421 34.1421C31.3451 36.9392 27.7814 38.844 23.9018 39.6157C20.0222 40.3874 16.0008 39.9913 12.3463 38.4776C8.69181 36.9638 5.56823 34.4004 3.37061 31.1114C1.17298 27.8224 0 23.9556 0 20H10C10 21.9778 10.5865 23.9112 11.6853 25.5557C12.7841 27.2002 14.3459 28.4819 16.1732 29.2388C18.0004 29.9957 20.0111 30.1937 21.9509 29.8078C23.8907 29.422 25.6725 28.4696 27.0711 27.0711C28.4696 25.6725 29.422 23.8907 29.8078 21.9509C30.1937 20.0111 29.9957 18.0004 29.2388 16.1732C28.4819 14.3459 27.2002 12.7841 25.5557 11.6853Z" fill="#007DFC"></path>
                    <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd" d="M10 5.16562e-07C10 1.31322 9.74135 2.61358 9.2388 3.82683C8.73625 5.04009 7.99966 6.14248 7.07107 7.07107C6.14249 7.99966 5.0401 8.73625 3.82684 9.2388C2.61358 9.74134 1.31322 10 5.4439e-06 10L5.00679e-06 20C2.62644 20 5.22716 19.4827 7.65368 18.4776C10.0802 17.4725 12.285 15.9993 14.1421 14.1421C15.9993 12.285 17.4725 10.0802 18.4776 7.65367C19.4827 5.22715 20 2.62643 20 -3.81469e-06L10 5.16562e-07Z" fill="#007DFC"></path>
                </svg>
                @break
            @case(4)
                <svg width="36" height="41" viewBox="0 0 36 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.88822 2.95639V0.521606H0.322998V2.95639V8.17378V17.2173V22.7825V22.9564C0.322998 32.6574 8.18721 40.5216 17.8882 40.5216C27.5892 40.5216 35.4534 32.6574 35.4534 22.9564V22.7825V17.2173V8.17378V2.95639V0.521606H29.8882V2.95639H20.4969V2.60856V0.521606H14.9317V2.60856V2.95639H5.88822ZM14.9317 34.5894C9.78296 33.2849 5.96086 28.652 5.88924 23.1147C6.48236 23.2584 7.06484 23.4481 7.63125 23.6827C9.06606 24.277 10.3698 25.1481 11.4679 26.2463C12.5661 27.3444 13.4372 28.6481 14.0315 30.0829C14.6234 31.5118 14.9292 33.0429 14.9317 34.5894ZM15.4031 22.3111C16.2746 23.1825 17.0488 24.142 17.7143 25.1723C18.3798 24.142 19.154 23.1825 20.0255 22.3111C20.8969 21.4396 21.8564 20.6654 22.8867 19.9999C21.8564 19.3344 20.8969 18.5601 20.0255 17.6887C19.154 16.8172 18.3798 15.8578 17.7143 14.8275C17.0488 15.8578 16.2746 16.8172 15.4031 17.6887C14.5317 18.5601 13.5722 19.3344 12.5419 19.9999C13.5722 20.6654 14.5317 21.4396 15.4031 22.3111ZM29.888 23.0359C29.851 28.7322 25.8451 33.4865 20.4969 34.672V34.6086C20.4969 33.0555 20.8028 31.5177 21.3971 30.0829C21.9914 28.6481 22.8625 27.3444 23.9607 26.2463C25.0588 25.1481 26.3625 24.277 27.7974 23.6827C28.4744 23.4023 29.1743 23.186 29.888 23.0359ZM14.5098 8.52161C14.3799 8.99519 14.2202 9.4612 14.0315 9.91682C13.4372 11.3516 12.5661 12.6553 11.4679 13.7535C10.3698 14.8516 9.06606 15.7227 7.63125 16.3171C7.06451 16.5518 6.48169 16.7416 5.88822 16.8852V8.52161H14.5098ZM29.8882 16.9639V8.52161H20.9188C21.0488 8.99519 21.2084 9.4612 21.3971 9.91682C21.9914 11.3516 22.8625 12.6553 23.9607 13.7535C25.0588 14.8516 26.3625 15.7227 27.7974 16.3171C28.4744 16.5975 29.1745 16.8137 29.8882 16.9639Z" fill="#09C382"></path>
                </svg>
                @break
        
            @default
                <svg width="36" height="41" viewBox="0 0 36 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.88822 2.95639V0.521606H0.322998V2.95639V8.17378V17.2173V22.7825V22.9564C0.322998 32.6574 8.18721 40.5216 17.8882 40.5216C27.5892 40.5216 35.4534 32.6574 35.4534 22.9564V22.7825V17.2173V8.17378V2.95639V0.521606H29.8882V2.95639H20.4969V2.60856V0.521606H14.9317V2.60856V2.95639H5.88822ZM14.9317 34.5894C9.78296 33.2849 5.96086 28.652 5.88924 23.1147C6.48236 23.2584 7.06484 23.4481 7.63125 23.6827C9.06606 24.277 10.3698 25.1481 11.4679 26.2463C12.5661 27.3444 13.4372 28.6481 14.0315 30.0829C14.6234 31.5118 14.9292 33.0429 14.9317 34.5894ZM15.4031 22.3111C16.2746 23.1825 17.0488 24.142 17.7143 25.1723C18.3798 24.142 19.154 23.1825 20.0255 22.3111C20.8969 21.4396 21.8564 20.6654 22.8867 19.9999C21.8564 19.3344 20.8969 18.5601 20.0255 17.6887C19.154 16.8172 18.3798 15.8578 17.7143 14.8275C17.0488 15.8578 16.2746 16.8172 15.4031 17.6887C14.5317 18.5601 13.5722 19.3344 12.5419 19.9999C13.5722 20.6654 14.5317 21.4396 15.4031 22.3111ZM29.888 23.0359C29.851 28.7322 25.8451 33.4865 20.4969 34.672V34.6086C20.4969 33.0555 20.8028 31.5177 21.3971 30.0829C21.9914 28.6481 22.8625 27.3444 23.9607 26.2463C25.0588 25.1481 26.3625 24.277 27.7974 23.6827C28.4744 23.4023 29.1743 23.186 29.888 23.0359ZM14.5098 8.52161C14.3799 8.99519 14.2202 9.4612 14.0315 9.91682C13.4372 11.3516 12.5661 12.6553 11.4679 13.7535C10.3698 14.8516 9.06606 15.7227 7.63125 16.3171C7.06451 16.5518 6.48169 16.7416 5.88822 16.8852V8.52161H14.5098ZM29.8882 16.9639V8.52161H20.9188C21.0488 8.99519 21.2084 9.4612 21.3971 9.91682C21.9914 11.3516 22.8625 12.6553 23.9607 13.7535C25.0588 14.8516 26.3625 15.7227 27.7974 16.3171C28.4744 16.5975 29.1745 16.8137 29.8882 16.9639Z" fill="#09C382"></path>
                </svg>
        @endswitch
        <div class="quick-scan-report-visualizer__header__text">
            @switch($count)
                @case(0)
                    <p class="quick-scan-report-visualizer__header__text__header">Nimbus Solutions</p>
                    <p class="quick-scan-report-visualizer__header__text__body">nimbus.com</p>
                    @break
                @case(1)
                    <p class="quick-scan-report-visualizer__header__text__header">Quantum Pixel</p>
                    <p class="quick-scan-report-visualizer__header__text__body">qpix.com</p>
                    @break
                @case(2)
                    <p class="quick-scan-report-visualizer__header__text__header">Cobalt Technologies</p>
                    <p class="quick-scan-report-visualizer__header__text__body">cobalt.com</p>
                    @break
                @case(3)
                    <p class="quick-scan-report-visualizer__header__text__header">Zenith Software</p>
                    <p class="quick-scan-report-visualizer__header__text__body">zs-solutions.com</p>
                    @break
                @case(4)
                    <p class="quick-scan-report-visualizer__header__text__header">Prism Digital Systems</p>
                    <p class="quick-scan-report-visualizer__header__text__body">prismsys.com</p>
                    @break
                @default
            @endswitch
        </div>
    </div>
    <div class="quick-scan-report-visualizer__body">
        {{-- Messaging --}}
        @switch($count)
            @case(0)
                <x-quick-scan-visualizer-item grade="C" header="Messaging" body="The value proposition is clear"></x-quick-scan-visualizer-item>
                @break
            @case(1)
                <x-quick-scan-visualizer-item grade="B" header="Messaging" body="Very direct and succinct"></x-quick-scan-visualizer-item>
                @break
            @case(2)
                <x-quick-scan-visualizer-item grade="D" header="Messaging" body="Unfocused and lacking clarity"></x-quick-scan-visualizer-item>
                @break
            @case(3)
                <x-quick-scan-visualizer-item grade="A" header="Messaging" body="Compelling and *really* clear"></x-quick-scan-visualizer-item>
                @break
            @case(4)
                <x-quick-scan-visualizer-item grade="B" header="Messaging" body="Solid; could improve brevity"></x-quick-scan-visualizer-item>
                @break
            @default
        @endswitch

        {{-- Scarcity --}}
        @switch($count)
            @case(0)
                <x-quick-scan-visualizer-item grade="B" header="Scarcity" body="It appears there are limited options"></x-quick-scan-visualizer-item>
                @break
            @case(1)
                <x-quick-scan-visualizer-item grade="F" header="Scarcity" body="Doesn't seem very scarce at all..."></x-quick-scan-visualizer-item>
                @break
            @case(2)
                <x-quick-scan-visualizer-item grade="A" header="Scarcity" body="Both time and quantity scarcity"></x-quick-scan-visualizer-item>
                @break
            @case(3)
                <x-quick-scan-visualizer-item grade="C" header="Scarcity" body="Could use more urgency"></x-quick-scan-visualizer-item>
                @break
            @case(4)
                <x-quick-scan-visualizer-item grade="B" header="Scarcity" body="Great use of time-based scarcity"></x-quick-scan-visualizer-item>
                @break
            @default
        @endswitch

        {{-- Social Proof --}}
        @switch($count)
            @case(0)
                <x-quick-scan-visualizer-item grade="C" header="Social Proof" body="A few testimonials; could show more"></x-quick-scan-visualizer-item>
                @break
            @case(1)
                <x-quick-scan-visualizer-item grade="F" header="Social Proof" body="Almost no social proof found"></x-quick-scan-visualizer-item>
                @break
            @case(2)
                <x-quick-scan-visualizer-item grade="B" header="Social Proof" body="A handful of testimonials found"></x-quick-scan-visualizer-item>
                @break
            @case(3)
                <x-quick-scan-visualizer-item grade="B" header="Social Proof" body="No testimonials, but a single case study"></x-quick-scan-visualizer-item>
                @break
            @case(4)
                <x-quick-scan-visualizer-item grade="C" header="Social Proof" body="Few testimonials found, not much more"></x-quick-scan-visualizer-item>
                @break
            @default
        @endswitch

        {{-- Page Load Time --}}
        @switch($count)
            @case(0)
                <x-quick-scan-visualizer-item grade="B" header="Page Load Time" body="Site loads in less then 2 seconds"></x-quick-scan-visualizer-item>
                @break
            @case(1)
                <x-quick-scan-visualizer-item grade="D" header="Page Load Time" body="Took almost 10 seconds to load"></x-quick-scan-visualizer-item>
                @break
            @case(2)
                <x-quick-scan-visualizer-item grade="B" header="Page Load Time" body="Decent load time, but many images"></x-quick-scan-visualizer-item>
                @break
            @case(3)
                <x-quick-scan-visualizer-item grade="C" header="Page Load Time" body="Took about 4 seconds to load"></x-quick-scan-visualizer-item>
                @break
            @case(4)
                <x-quick-scan-visualizer-item grade="A" header="Page Load Time" body="Site loads almost instantly!"></x-quick-scan-visualizer-item>
                @break
            @default
        @endswitch
    </div>
</div>