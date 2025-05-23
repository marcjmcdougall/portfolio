@php
    $source = htmlspecialchars(request()->query('utm_source', ''), ENT_QUOTES, 'UTF-8');
    $medium = htmlspecialchars(request()->query('utm_medium', ''), ENT_QUOTES, 'UTF-8');
    $campaign = htmlspecialchars(request()->query('utm_campaign', ''), ENT_QUOTES, 'UTF-8');

    $allowedDomains = ['clarityfirst.co', 'kilobytestudios.org'];
    $showNotification = $source && in_array($source, $allowedDomains) || 'course-referral' === $campaign;
    
    $bodyContent = '';

    if( 'course-referral' == $campaign ) {
        $bodyContent = 'Hey there!  It looks like someone sent this to you because they think you\'ll like it.  I hope you enjoy it here';
    } else if ('clarityfirst.co' === $source || 'kilobytestudios.org' === $source ) {
        $bodyContent = 'You\'ve been redirected from <strong>' . $source .  '</strong> as I\'ve updated my domain, I hope you enjoy it here';
    }
@endphp

@if($showNotification)
    <div class="redirect-detector">
        {{-- <div class="redirect-detector__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M9.06095 5.81248C8.81623 5.38205 8.7517 4.87231 8.88142 4.39448C9.01115 3.91665 9.32461 3.50953 9.7534 3.26196C10.1822 3.01439 10.6915 2.94648 11.1702 3.07303C11.6489 3.19959 12.058 3.51034 12.3085 3.93748L15.121 8.81248" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.49875 8.87519L5.16375 6.56238C4.91511 6.13161 4.84777 5.61971 4.97656 5.1393C5.10534 4.65888 5.4197 4.2493 5.85047 4.00066C6.28124 3.75202 6.79314 3.68469 7.27355 3.81347C7.75397 3.94226 8.16355 4.25661 8.41219 4.68738L11.3344 9.74988" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.894 15.0001C14.3543 14.2025 14.1421 13.2278 14.3014 12.278C14.4608 11.3281 14.9794 10.476 15.75 9.89825L15.1237 8.81262C14.8751 8.38148 14.8079 7.86922 14.9369 7.38854C15.066 6.90787 15.3807 6.49814 15.8118 6.2495C16.243 6.00086 16.7552 5.93367 17.2359 6.06272C17.7166 6.19177 18.1263 6.50648 18.375 6.93762L19.9978 9.75012C20.4902 10.6034 20.8098 11.5453 20.9383 12.522C21.0667 13.4987 21.0015 14.4912 20.7464 15.4428C20.4913 16.3943 20.0512 17.2863 19.4514 18.0678C18.8516 18.8493 18.1037 19.505 17.2504 19.9975C15.5272 20.992 13.4795 21.2613 11.5578 20.7461C9.63602 20.2309 7.99765 18.9733 7.00309 17.2501L3.25309 10.7514C3.00837 10.321 2.94384 9.81121 3.07356 9.33338C3.20329 8.85555 3.51675 8.44843 3.94554 8.20086C4.37433 7.95329 4.88363 7.88537 5.36231 8.01193C5.84099 8.13848 6.25018 8.44924 6.50059 8.87637L8.3034 12.0001" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18 3.16699C18.6203 3.33078 19.202 3.61574 19.7115 4.00546C20.2211 4.39517 20.6485 4.88191 20.9691 5.43762L21 5.49105" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.99563 21.75C5.94971 20.9236 5.0709 19.9055 4.40625 18.75" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div> --}}
        <svg class="desktop-only" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9.06095 5.81248C8.81623 5.38205 8.7517 4.87231 8.88142 4.39448C9.01115 3.91665 9.32461 3.50953 9.7534 3.26196C10.1822 3.01439 10.6915 2.94648 11.1702 3.07303C11.6489 3.19959 12.058 3.51034 12.3085 3.93748L15.121 8.81248" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.49875 8.87519L5.16375 6.56238C4.91511 6.13161 4.84777 5.61971 4.97656 5.1393C5.10534 4.65888 5.4197 4.2493 5.85047 4.00066C6.28124 3.75202 6.79314 3.68469 7.27355 3.81347C7.75397 3.94226 8.16355 4.25661 8.41219 4.68738L11.3344 9.74988" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.894 15.0001C14.3543 14.2025 14.1421 13.2278 14.3014 12.278C14.4608 11.3281 14.9794 10.476 15.75 9.89825L15.1237 8.81262C14.8751 8.38148 14.8079 7.86922 14.9369 7.38854C15.066 6.90787 15.3807 6.49814 15.8118 6.2495C16.243 6.00086 16.7552 5.93367 17.2359 6.06272C17.7166 6.19177 18.1263 6.50648 18.375 6.93762L19.9978 9.75012C20.4902 10.6034 20.8098 11.5453 20.9383 12.522C21.0667 13.4987 21.0015 14.4912 20.7464 15.4428C20.4913 16.3943 20.0512 17.2863 19.4514 18.0678C18.8516 18.8493 18.1037 19.505 17.2504 19.9975C15.5272 20.992 13.4795 21.2613 11.5578 20.7461C9.63602 20.2309 7.99765 18.9733 7.00309 17.2501L3.25309 10.7514C3.00837 10.321 2.94384 9.81121 3.07356 9.33338C3.20329 8.85555 3.51675 8.44843 3.94554 8.20086C4.37433 7.95329 4.88363 7.88537 5.36231 8.01193C5.84099 8.13848 6.25018 8.44924 6.50059 8.87637L8.3034 12.0001" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 3.16699C18.6203 3.33078 19.202 3.61574 19.7115 4.00546C20.2211 4.39517 20.6485 4.88191 20.9691 5.43762L21 5.49105" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.99563 21.75C5.94971 20.9236 5.0709 19.9055 4.40625 18.75" stroke="#011627" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p>{!! $bodyContent !!}</p>
    </div>
@endif