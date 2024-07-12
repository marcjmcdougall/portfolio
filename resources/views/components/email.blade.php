<div class="email has-animation">
    <svg class="email__checkbox" xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
        <g opacity="0.4">
            <path d="M17.4167 3.25H4.58333C3.57081 3.25 2.75 4.07081 2.75 5.08333V17.9167C2.75 18.9292 3.57081 19.75 4.58333 19.75H17.4167C18.4292 19.75 19.25 18.9292 19.25 17.9167V5.08333C19.25 4.07081 18.4292 3.25 17.4167 3.25Z" stroke="#1F252F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
    </svg>
    <div class="email__content">
        <p @class([
            'email__subject',
            'margin-top--strip',
            'margin-bottom--strip',
            'email__subject--unread' => $unread ?? false,
        ])>
            {{ $subject ?? 'Lesson #1: The audience' }}
        </p>
        <p class="email__body margin-top--strip margin-bottom--strip">
            {{ $body ?? 'These are the fundamentals' }}
        </p>
    </div>
</div>