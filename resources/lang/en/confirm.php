<?php
return [
    'default' => [
        'delete' => [
            'title'   => 'Delete',
            'content' => 'Do you really want to delete :name ?',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ],
        'post'   => [
            'title'   => 'Create',
            'content' => 'Do you really want to save this data?',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ],
        'put'    => [
            'title'   => 'Update',
            'content' => 'Do you really want to update :name with these changes?',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ]
    ],

    'track' => [
        'delete' => [
            'title'   => 'Delete track',
            'content' => 'Do you really want to delete the track :name?'
        ],
    ],

    'category' => [
        'delete' => [
            'title'   => 'Delete category',
            'content' => 'Do you really want to delete the category :name?'
        ],
    ],

    'enable_maintenance_mode' => [
        'post' => [
            'title'   => 'Enable maintenance mode',
            'content' => 'Do you really want to enable the maintenance mode? Visitors will be redirected to the maintenance page of the website.',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ]
    ],

    'disable_maintenance_mode' => [
        'post' => [
            'title'   => 'Disable maintenance mode',
            'content' => 'Do you really want to disable the maintenance mode? Visitors can see the regular content of the website again.',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ]
    ],

    'clear_cache' => [
        'post' => [
            'title'   => 'Clear the cache',
            'content' => 'Do you really want to clear the cache? There can be long loading times for the visitors during this process.',
            'accept'  => 'Yes',
            'cancel'  => 'No'
        ]
    ],
];
