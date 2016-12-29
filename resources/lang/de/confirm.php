<?php
return [
    'default' => [
        'delete' => [
            'title'   => 'Löschen',
            'content' => 'Möchtest du :name wirklich löschen?',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ],
        'post'   => [
            'title'   => 'Erstellen',
            'content' => 'Möchtest du das Objekt mit diesen Eingaben erstellen?',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ],
        'put'    => [
            'title'   => 'Aktualisieren',
            'content' => 'Möchtest du :name mit diesen Eingaben aktualisieren?',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ]
    ],

    'track' => [
        'delete' => [
            'title'   => 'Track löschen',
            'content' => 'Möchtest du den Track :name wirklich löschen?'
        ],
    ],

    'category' => [
        'delete' => [
            'title'   => 'Kategorie löschen',
            'content' => 'Möchtest du die Kategorie :name wirklich löschen?'
        ],
    ],

    'enable_maintenance_mode' => [
        'post' => [
            'title'   => 'Wartungsmodus aktivieren',
            'content' => 'Möchtest du den Wartungsmodus wirklich aktivieren? Benutzer können den Blog dann nicht mehr sehen und werden auf eine Benachrichtigungsseite weitergeleitet.',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ]
    ],

    'disable_maintenance_mode' => [
        'post' => [
            'title'   => 'Wartungsmodus aufheben',
            'content' => 'Möchtest du den Wartungsmodus wirklich aufheben? Benutzer können den Blog danach wieder regulär sehen.',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ]
    ],

    'clear_cache' => [
        'post' => [
            'title'   => 'Cache löschen',
            'content' => 'Möchtest du den Cache wirklich löschen? Es kann zu langen Ladezeiten für die Benutzer kommen, während der Cache gelöscht wird.',
            'accept'  => 'Ja',
            'cancel'  => 'Nein'
        ]
    ],
];