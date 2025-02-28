<?php

return [
    // Default metadata settings
    'defaults' => [
        'title' => 'Marc McDougall – Landing page design that converts',
        'description' => 'Simple, customer-centric landing pages that drive seriously awesome business results.',
        'author' => 'Marc J. McDougall',
        'og_image' => 'img/social/default.jpg',
        'twitter_handle' => '@marcjmcdougall',
        'keywords' => 'conversion rate optimization, landing page design, software marketing, clarity call, SaaS conversion',
    ],
    
    // Social media specific settings
    'social' => [
        'facebook' => [
            'app_id' => env('FACEBOOK_APP_ID', ''),
            'admin_id' => env('FACEBOOK_ADMIN_ID', ''),
        ],
        'twitter' => [
            'card' => 'summary_large_image',
            'site' => '@marcjmcdougall',
        ],
    ],
];