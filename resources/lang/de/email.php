<?php

return [

    'greeting' => 'Hallo :name',
    'greeting_plain' => 'Hallo',
    'salutation' => 'Viele Grüße',
    'any_questions'  => 'Du hast Fragen oder benötigst Hilfe?',
    'button_help' => 'Falls du Probleme hast den ":button" Button zu klicken, kopiere den folgenden Link und füge ihn in deinen Browser ein',


    'password_reset'                         => [
        'title'   => ':title: Dein neues Passwort',
        'content' => 'du hast soeben ein neues Passwort für deinen Account bei :title angefragt. Klicke auf den folgenden Button, um dein Passwort zurückzusetzen. Solltest du nicht um eine Zurücksetzung deines Passworts gebeten haben, so kannst du diese E-Mail ignorieren.'
    ],

    'error' => [
        'subject'        => ':title: Es ist ein Fehler auf der Seite aufgetreten',
        'title'          => 'Fehler :(',
        'content'        => 'es ist soeben der folgende Fehler aufgetreten. Bitte kontrolliere die Log-Datei für mehr Details.',
        'receiving_info' => 'Du erhälst diese E-Mail, weil deine E-Mail-Adresse als Support-E-Mail-Adresse auf :title hinterlegt ist.'
    ],

    'track_created' => [
        'subject'        => ':title: Neuer Track hochgeladen',
        'title'          => 'Neuer Track',
        'content'        => ':author hat soeben den Track ":title" von :composer auf :name hochgeladen. Klicke auf den folgenden Button, um ihn dir anzuhören.',
        'receiving_info' => 'Du erhälst diese E-Mail, weil du auf der Seite :title als Administrator registriert bist.'
    ],

    'contact' => [
        'subject'        => 'Neue Kontaktnachricht auf der :title Website',
        'title'          => 'Neue Kontaktnachricht',
        'content'        => 'es wurde soeben eine neue Kontaktnachricht durch das Kontaktformular auf :title verfasst:',
        'receiving_info' => 'Du erhälst diese E-Mail, weil deine E-Mail-Adresse als Kontakt-E-Mail-Adresse auf :title hinterlegt ist.'
    ],

    'registration' => [
        'subject'        => 'Deine Registrierung bei :name',
        'title'          => 'Registrierungsbestätigung',
        'content'        => 'für dich wurde soeben ein neuer Account auf der Seite :name erstellt. Bitte logge dich mit den folgenden Daten ein und ändere dein Passwort.',
        'receiving_info' => 'Du erhälst diese E-Mail, weil für dich auf der Seite :title ein Account erstellt worden ist. Solltest du von dieser Aktion nicht informiert worden sein, so kannst du diese E-Mail ignorieren.'
    ],

    'test' => [
        'subject'        => 'Test-E-Mail von :title',
        'title'          => 'Hier steht der Titel der E-Mail!',
        'content'        => 'hier steht der Hauptinhalt der E-Mail, welcher dem Empfänger wichtige Informationen mitteilt. Hier steht beispielsweise der Inhalt eines Newsletters. Dieser Inhalt kann zusätzlich dynamische Daten über Benutzer von :title enthalten.',
        'receiving_info' => 'Du erhälst diese E-Mail, weil auf :title eine Test-E-Mail angefordert wurde.'
    ],
];
