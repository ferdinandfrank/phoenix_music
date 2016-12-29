<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Das Feld following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Das Feld :attribute must be accepted.',
    'active_url'           => 'Das Feld :attribute ist keine gültige URL.',
    'after'                => 'Das Feld :attribute must be a date after :date.',
    'alpha'                => 'Das Feld :attribute may only contain letters.',
    'alpha_dash'           => 'Das Feld :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Das Feld :attribute may only contain letters and numbers.',
    'array'                => 'Das Feld :attribute must be an array.',
    'before'               => 'Das Feld :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'Das Feld :attribute must be between :min and :max.',
        'file'    => 'Das Feld :attribute must be between :min and :max kilobytes.',
        'string'  => 'Das Feld :attribute must be between :min and :max characters.',
        'array'   => 'Das Feld :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'Das Feld :attribute field must be true or false.',
    'confirmed'            => 'Das Feld :attribute confirmation does not match.',
    'date'                 => 'Das Feld :attribute ist kein gültiges Datum.',
    'date_format'          => 'Das Feld :attribute does not match the format :format.',
    'different'            => 'Das Feld :attribute and :other must be different.',
    'digits'               => 'Das Feld :attribute must be :digits digits.',
    'digits_between'       => 'Das Feld :attribute must be between :min and :max digits.',
    'dimensions'           => 'Das Feld :attribute has invalid image dimensions.',
    'distinct'             => 'Das Feld :attribute field has a duplicate value.',
    'email'                => 'Bitte gebe eine gültige E-Mail Adresse ein.',
    'exists'               => 'Das Feld selected :attribute is invalid.',
    'file'                 => 'Das Feld :attribute must be a file.',
    'filled'               => 'Das Feld :attribute field is required.',
    'image'                => 'Bitte wähle eine gültige Bilddatei aus.',
    'in'                   => 'Das Feld selected :attribute is invalid.',
    'in_array'             => 'Das Feld :attribute field does not exist in :other.',
    'integer'              => 'Das Feld :attribute must be an integer.',
    'ip'                   => 'Das Feld :attribute must be a valid IP address.',
    'json'                 => 'Das Feld :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'Bitte gebe weniger als :max Zeichen ein.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Die Datei muss vom Typ :values sein.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'Bitte gebe mind. :min Zeichen ein.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'Das Feld selected :attribute is invalid.',
    'numeric'              => 'Das Feld :attribute must be a number.',
    'present'              => 'Das Feld :attribute field must be present.',
    'regex'                => 'Das Feld :attribute format is invalid.',
    'required'             => 'Bitte fülle dieses Feld aus.',
    'required_if'          => 'Das Feld :attribute field is required when :other is :value.',
    'required_unless'      => 'Das Feld :attribute field is required unless :other is in :values.',
    'required_with'        => 'Das Feld :attribute field is required when :values is present.',
    'required_with_all'    => 'Das Feld :attribute field is required when :values is present.',
    'required_without'     => 'Das Feld :attribute field is required when :values is not present.',
    'required_without_all' => 'Das Feld :attribute field is required when none of :values are present.',
    'same'                 => 'Das Feld :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Das Feld :attribute must be :size.',
        'file'    => 'Das Feld :attribute must be :size kilobytes.',
        'string'  => 'Das Feld :attribute must be :size characters.',
        'array'   => 'Das Feld :attribute must contain :size items.',
    ],
    'string'               => 'Das Feld :attribute must be a string.',
    'timezone'             => 'Das Feld :attribute must be a valid zone.',
    'unique'               => 'Das Feld :attribute has already been taken.',
    'uploaded'             => 'Das Feld :attribute failed to upload.',
    'url'                  => 'Bitte gebe eine gültige URL ein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Das Feld following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

    'password' => [
        'email' => [
            'exists' => 'Diese E-Mail Adresse ist im System nicht registriert.'
        ]
    ]

];
