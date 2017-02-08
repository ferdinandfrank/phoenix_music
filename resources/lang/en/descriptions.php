<?php

return [
    'licensing'                => 'If you are interested in using one of our tracks/sounds in your project, you\'ll need to license this track/sound either on Audiojungle or SongsToYourEyes. If you are interested in an individual track composition, that fits your project, feel free to contact us.',
    'licensing_on_audiojungle' => 'The following tracks/sounds are available for licensing on AudioJungle',
    'licensing_on_stye'        => 'The following tracks/sounds are available for licensing on SongsToYourEyes',
    'contact'                  => 'Feel free to contact us, if you have any questions or requests about our music. We are also happy for every feedback from your side.',
    'categories_index'         => 'Here you can see a listing of all the created track categories',
    'tracks_index'             => 'Here you can see a listing of all the uploaded tracks',
    'users_index'              => 'Here you can see a listing of all the composers',
    'albums_index'             => 'Here you can see a listing of all the created albums',
    'changelog_index'          => 'Here you can see a listing of all the latest Commits (Updates) of the portfolio',
    'logo'                     => 'The logo will be displayed on the navigation bars, as well as on top of the sent emails.',
    'cover'                    => 'The background image will be used as the background of the frontend.',
    'favicon'                  => 'The favicon will be displayed on the browser\'s page tab next to the website title. This should be a ".png" file.',
    'intro_video'              => 'The intro video will be played on the index page of the website.',
    'enable_maintenance_mode'  => 'Enable the maintenance mode to redirect the visitors of the website to a "505 - Be right back" page. Users with the role "admin" or "manager" can still visit all pages.',
    'disable_maintenance_mode' => 'Disable the maintenance mode to make the website available again for visitors.',
    'export_data'              => 'Export the data of the databases as an Excel file.',
    'manage_log'               => 'Download the log file to see if any error occurred on the website or clear the file to delete the content of the log file.',
    'create_database_backup'   => 'Create a backup of your database, so the data can be restored if an error occurs on the database.',
    'reset_index'              => 'Regenerate the search index to make the data in the database searchable.',
    'clear_cache'              => 'Clear the websites cache to regenerate the web routes, view files, and the general cache of the website. This may be used if an error occurred by visiting a page of the website to regenerate the file of the page.',
    'send_test_mail'           => 'Send a test mail to the application\'s sender email address "'
                                  . config('mail.from.address') . '" to check the email configurations.'
];
