<?php

return [

    'error' => [
        'delete' => [
            'title'   => 'Sorry',
            'content' => 'Beim Löschen von :name ist ein unbekannter Fehler aufgetreten. Bitte versuche es noch einmal.'
        ],
        'post'   => [
            'title'   => 'Sorry!',
            'content' => 'Beim Erstellen ist ein unbekannter Fehler aufgetreten. Bitte versuche es noch einmal.'
        ],
        'put'    => [
            'title'   => 'Sorry!',
            'content' => 'Beim Aktualisieren von :name ist ein unbekannter Fehler aufgetreten. Bitte versuche es noch einmal.'
        ]
    ],

    'default' => [
        'delete' => [
            'title'   => 'Gelöscht',
            'content' => ':name wurde erfolgreich gelöscht.'
        ],
        'post'   => [
            'title'   => 'Gespeichert',
            'content' => 'Die Daten wurden gespeichert.'
        ],
        'put'    => [
            'title'   => 'Gespeichert',
            'content' => 'Die Änderungen an :name wurden gespeichert.'
        ]
    ],

    'password_reset' => [
        'post' => [
            'title'   => 'Password zurückgesetzt',
            'content' => 'Dein Passwort wurde erfolgreich zurückgesetzt.'
        ]
    ],

    'password_forgot' => [
        'post' => [
            'title'   => 'E-Mail gesendet!',
            'content' => 'Wir haben dir eine E-Mail zum Zurücksetzen deines Passworts zugeschickt.'
        ]
    ],

    'track' => [
        'post'   => [
            'title'   => 'Track hochgeladen',
            'content' => 'Der Track wurde gespeichert.'
        ],
        'put'    => [
            'title'   => 'Track aktualisiert',
            'content' => 'Die Änderungen an dem Track :name wurden gespeichert.'
        ],
        'delete' => [
            'title'   => 'Track gelöscht',
            'content' => 'Der Track :name wurde erfolgreich gelöscht.'
        ],
    ],

    'category' => [
        'post'   => [
            'title'   => 'Kategorie erstellt',
            'content' => 'Die Kategorie wurde gespeichert.'
        ],
        'put'    => [
            'title'   => 'Kategorie aktualisiert',
            'content' => 'Die Änderungen an der Kategorie :name wurden gespeichert.'
        ],
        'delete' => [
            'title'   => 'Kategorie gelöscht',
            'content' => 'Die Kategorie :name wurde erfolgreich gelöscht.'
        ],
    ],

    'album' => [
        'post'   => [
            'title'   => 'Album erstellt',
            'content' => 'Das Album wurde gespeichert.'
        ],
        'put'    => [
            'title'   => 'Album aktualisiert',
            'content' => 'Die Änderungen an dem Album :name wurden gespeichert.'
        ],
        'delete' => [
            'title'   => 'Album gelöscht',
            'content' => 'Das Album :name wurde erfolgreich gelöscht.'
        ],
    ],

    'user' => [
        'post'   => [
            'title'   => 'Benutzer erstellt',
            'content' => 'Der Benutzer wurde erstellt. Er erhält in den nächsten Minuten eine E-Mail an seine E-Mail-Adresse, welche er bestätigen muss.'
        ],
        'put'    => [
            'title'   => 'Benutzer aktualisiert',
            'content' => 'Die Änderungen an dem Benutzer :name wurden gespeichert.'
        ],
        'delete' => [
            'title'   => 'Benutzer gelöscht',
            'content' => 'Der Benutzer :name wurde erfolgreich gelöscht.'
        ],
    ],

    'contact' => [
        'post' => [
            'title'   => 'Danke!',
            'content' => 'Wir werden deine Nachricht innerhalb der nächsten Tage lesen.'
        ]
    ],

    'settings' => [
        'put' => [
            'title'   => 'Einstellungen aktualisiert',
            'content' => 'Die Einstellungen wurden gespeichert.'
        ],
    ],

    'enable_maintenance_mode' => [
        'post' => [
            'title'   => 'Wartungsmodus aktiviert',
            'content' => 'Der Wartungsmodus wurde aktiviert. Besucher werden nun auf eine Wartungsseite weitergeleitet.'
        ]
    ],

    'disable_maintenance_mode' => [
        'post' => [
            'title'   => 'Wartungsmodus deaktiviert',
            'content' => 'Der Wartungsmodus wurde deaktiviert. Besucher können nun wieder den regulären Inhalt der Website sehen.'
        ]
    ],

    'clear_cache' => [
        'post' => [
            'title'   => 'Cache gelöscht',
            'content' => 'Der Cache der Webseite wurde gelöscht.'
        ]
    ],

    'clear_log' => [
        'post' => [
            'title'   => 'Log-Datei zurückgesetzt',
            'content' => 'Der Inhalt der Log-Datei wurde erfolgreich gelöscht.'
        ]
    ],

    'reset_index' => [
        'post' => [
            'title'   => 'Suchindex zurückgesetzt',
            'content' => 'Der Suchindex wurde zurückgesetzt.'
        ]
    ],

    'create_backup' => [
        'post' => [
            'title'   => 'Datenbank Backup erstellt',
            'content' => 'Ein Backup Skript der Datenbank wurde gespeichert.'
        ]
    ],

    'send_test_mail' => [
        'post' => [
            'title'   => 'Test E-Mail versendet',
            'content' => 'Eine Testnachricht wurde erfolgreich an ' . config('mail.from.address') . ' versendet.'
        ]
    ],

    'media' => [
        'create_folder' => 'Der Ordner :name wurde erfolgreich erstellt.',
        'delete_folder' => 'Der Ordner :name wurde erfolgreich gelöscht.',
        'delete_file'   => 'Die Datei :name wurde erfolgreich gelöscht.',
        'upload_file'   => 'Die Dateien wurden erfolgreich hochgeladen.',
        'rename_file'   => 'Die Datei :old wurde erfolgreich in :new umbenannt.',
        'move_file'     => 'Die Datei :name wurde erfolgreich nach :path verschoben.'
    ]

];
