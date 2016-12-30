<?php

return [

    'error' => [
        'delete' => [
            'title'   => 'Sorry',
            'content' => 'An error occurred while trying to delete :name. Please try again.'
        ],
        'post'   => [
            'title'   => 'Sorry!',
            'content' => 'An error occurred while trying to save the data. Please try again.'
        ],
        'put'    => [
            'title'   => 'Sorry!',
            'content' => 'An error occurred while trying to update :name. Please try again.'
        ]
    ],

    'default' => [
        'delete' => [
            'title'   => 'Deleted',
            'content' => ':name has been deleted.'
        ],
        'post'   => [
            'title'   => 'Saved',
            'content' => 'The data has been saved.'
        ],
        'put'    => [
            'title'   => 'Saved',
            'content' => 'The changes on :name have been saved.'
        ]
    ],

    'password_reset' => [
        'post' => [
            'title'   => 'Password reset',
            'content' => 'Your password has been successfully reset.'
        ]
    ],

    'password_forgot' => [
        'post' => [
            'title'   => 'E-Mail sent!',
            'content' => 'We have sent you an email to reset your password.'
        ]
    ],

    'track' => [
        'post'   => [
            'title'   => 'Track uploaded',
            'content' => 'The track has been saved.'
        ],
        'put'    => [
            'title'   => 'Track updated',
            'content' => 'The changes on the track :name have been saved.'
        ],
        'delete' => [
            'title'   => 'Track deleted',
            'content' => 'The track :name has been deleted.'
        ],
    ],

    'category' => [
        'post'   => [
            'title'   => 'Category created',
            'content' => 'The category has been saved.'
        ],
        'put'    => [
            'title'   => 'Category updated',
            'content' => 'The changes on the category :name have been saved.'
        ],
        'delete' => [
            'title'   => 'Category deleted',
            'content' => 'The category :name has been deleted.'
        ],
    ],

    'user' => [
        'post'   => [
            'title'   => 'User created',
            'content' => 'The user has been saved.'
        ],
        'put'    => [
            'title'   => 'User updated',
            'content' => 'The changes on the user :name have been saved.'
        ],
        'delete' => [
            'title'   => 'User deleted',
            'content' => 'The user :name has been deleted.'
        ],
    ],

    'contact' => [
        'post' => [
            'title'   => 'Thank you!',
            'content' => 'We will read your message within the next few days.'
        ]
    ],

    'settings' => [
        'put' => [
            'title'   => 'Settings updated',
            'content' => 'The settings have been saved.'
        ],
    ],

    'enable_maintenance_mode' => [
        'post' => [
            'title'   => 'Maintenance mode enabled',
            'content' => 'The maintenance mode has been enabled. Visitors will now be redirected to the maintenance page.'
        ]
    ],

    'disable_maintenance_mode' => [
        'post' => [
            'title'   => 'Maintenance mode disabled',
            'content' => 'The maintenance mode has been disabled. Visitors can now see your regular data on your page again.'
        ]
    ],

    'clear_cache' => [
        'post' => [
            'title'   => 'Cache cleared',
            'content' => 'The cache of the website has been cleared.'
        ]
    ],

    'clear_log' => [
        'post' => [
            'title'   => 'Log file reset',
            'content' => 'The content of the log file has been deleted.'
        ]
    ],

    'reset_index' => [
        'post' => [
            'title'   => 'Search index reset',
            'content' => 'The search index has been reset.'
        ]
    ],

    'create_backup' => [
        'post' => [
            'title'   => 'Database backup created',
            'content' => 'A backup script has been stored on your file storage.'
        ]
    ],

    'send_test_mail' => [
        'post' => [
            'title'   => 'Test Email sent',
            'content' => 'A test email has been successfully sent to ' . config('mail.from.address') . '.'
        ]
    ],

    'media' => [
        'create_folder' => 'The folder :name has been successfully created.',
        'delete_folder' => 'The folder :name has been successfully deleted.',
        'delete_file'   => 'The file :name has been successfully deleted.',
        'upload_file'   => 'The files have been successfully uploaded.',
        'rename_file'   => 'The file :old has been successfully renamed to :new.',
        'move_file'     => 'The file :name has been successfully moved to :path.'
    ]

];
