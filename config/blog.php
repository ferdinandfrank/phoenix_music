<?php

/*
    |--------------------------------------------------------------------------
    | System specific settings
    |--------------------------------------------------------------------------
    |
    | Defines the enum values to use in the database.
    */
return [
    'user_type' => [
        'blogger'     => 0,
        'manager'     => 1,
        'admin'       => 2,
        'super_admin' => 3,
    ],

    'settings' => [
        'comment_type' => [
            'none'   => 'NONE',
            'disqus' => 'DISQUS',
            'custom' => 'CUSTOM'
        ]
    ],

    'advertisement' => [
        'type' => [
            'image' => 'IMAGE',
            'video' => 'VIDEO'
        ],

        'location' => [
            'sidebar' => 'SIDEBAR',
            'top'    => 'TOP'
        ]
    ],

    'newsletter_sources' => [
        'blog'   => 0,
        'survey' => 1,
        'test'   => 2
    ]
];