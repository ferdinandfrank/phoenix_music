<?php

return [

    'greeting' => 'Hello :name',
    'greeting_plain' => 'Hello',
    'salutation' => 'Best Regards',
    'any_questions'  => 'You have any questions or comments?',
    'button_help' => 'If you are having troubles clicking the ":button" button, copy the following link and paste it within your browser',


    'password_reset'                         => [
        'title'   => ':title: Your new password',
        'content' => 'you have requested a reset of your password on the website :title. Please click the following button to change your password. If you did not request a password reset, no further action is required.'
    ],

    'error' => [
        'subject'        => ':title: An error occurred',
        'title'          => 'Error :(',
        'content'        => 'the following error just occurred. Please check the log file for more details.',
        'receiving_info' => 'You are receiving this email, because this email address is saved as the technical contact email address on :title.'
    ],

    'track_created' => [
        'subject'        => ':title: New track uploaded',
        'title'          => 'New Track',
        'content'        => ':author just uploaded the track ":title" by :composer on the :name website. Press the following button to view the new track.',
        'receiving_info' => 'You are receiving this email, because you are registered as an administrator on :title.'
    ],

    'contact' => [
        'subject'        => 'New contact message on the :title website',
        'title'          => 'New Contact Message',
        'content'        => 'a new contact message has just been created on the contact form of the :title website:',
        'receiving_info' => 'You are receiving this email, because this email address is saved as the contact email address on :title.'
    ],

    'registration' => [
        'subject'        => 'Your Registration at :name',
        'title'          => 'Registration Confirmation',
        'content'        => 'an account has just been created for you on :name. Please login with the following credentials and change your password.',
        'receiving_info' => 'You are receiving this email, because an account has been created for you on :title. If you did not get informed about this action, you can ignore this email.'
    ],

    'test' => [
        'subject'        => 'Test-Email from :title',
        'title'          => 'This Is The Title Of The E-Mail!',
        'content'        => 'this is the main content of the email. Admins can be notified about newly uploaded tracks or specific information on :title.',
        'receiving_info' => 'You are receiving this email, because a test email was requested on :title'
    ],
];
