<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines bevatten the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Het veld :attribute moet geaccepteerd worden.',
    'accepted_if' => 'Het veld :attribute moet geaccepteerd worden wanneer :other is :value.',
    'active_url' => 'Het veld :attribute moet een geldige URL zijn.',
    'after' => 'Het veld :attribute moet een datum zijn na :date.',
    'after_or_equal' => 'Het veld :attribute moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'Het veld :attribute mag enkel letters bevatten.',
    'alpha_dash' => 'Het veld :attribute mag enkel letters, cijfers, dashes, en underscores bevatten.',
    'alpha_num' => 'Het veld :attribute  mmag enkel letters en cijfers bevatten.',
    'array' => 'Het veld :attribute moet een array zijn.',
    'ascii' => 'Het veld :attribute mag enkel bevatten single-byte alphanumeric karakters en symbols.',
    'before' => 'Het veld :attribute moet een datum zijn voor :date.',
    'before_or_equal' => 'Het veld :attribute moet een datum zijn voor of gelijk aan :date.',
    'between' => [
        'array' => 'Het veld :attribute moet tussen :min en :max items hebben.',
        'file' => 'Het veld :attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet tussen :min en :max zijn.',
        'string' => 'Het veld :attribute moet tussen :min en :max karakters hebben.',
    ],
    'boolean' => 'Het veld :attribute moet true of false zijn.',
    'can' => 'Het veld :attribute bevat een niet geauthorizeerde waarde.',
    'confirmed' => 'Het veld :attribute bevestiging is niet gelijk.',
    'current_password' => 'Het wachtwoord is niet correct.',
    'date' => 'Het veld :attribute moet een geldige datum zijn.',
    'date_equals' => 'Het veld :attribute moet een datum zijn gelijk aan :date.',
    'date_format' => 'Het veld :attribute moet voldoen aan het formaat :format.',
    'decimal' => 'Het veld :attribute moet :decimal decimal places hebben.',
    'declined' => 'Het veld :attribute moet declined zijn.',
    'declined_if' => 'Het veld :attribute moet zijn declined wanneer :other is :value.',
    'different' => 'Het veld :attribute en :other moet verschillend zijn.',
    'digits' => 'Het veld :attribute moet :digits digits zijn.',
    'digits_between' => 'Het veld :attribute moet tussen:min en :max digits zijn.',
    'dimensions' => 'Het veld :attribute heeft een ongeldige afbeeldingsgrootte.',
    'distinct' => 'Het veld :attribute heeft een dubbele waarde.',
    'doesnt_end_with' => 'Het veld :attribute mag niet eindigen met: :values.',
    'doesnt_start_with' => 'Het veld :attribute mag niet starten met: :values.',
    'email' => 'Het veld :attribute moet een geldig mailadres zijn.',
    'ends_with' => 'Het veld :attribute moet eindigen met: :values.',
    'enum' => 'The selected :attribute is ongeldig.',
    'exists' => 'The selected :attribute is ongeldig.',
    'extensions' => 'Het veld :attribute moet een van de volgende extensies hebben: :values.',
    'file' => 'Het veld :attribute moet een bestand zijn.',
    'filled' => 'Het veld :attribute moet een waarde hebben.',
    'gt' => [
        'array' => 'Het veld :attribute moet meer dan :value items hebben.',
        'file' => 'Het veld :attribute moet groter zijn dan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet groter zijn dan :value.',
        'string' => 'Het veld :attribute moet groter zijn dan :value karakters.',
    ],
    'gte' => [
        'array' => 'Het veld :attribute moet :value items hebben of meer.',
        'file' => 'Het veld :attribute moet groter zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet groter zijn dan of gelijk aan :value.',
        'string' => 'Het veld :attribute moet groter zijn dan of gelijk aan :value karakters.',
    ],
    'hex_color' => 'Het veld :attribute moet een geldig hexadecimaal kleur zijn.',
    'image' => 'Het veld :attribute moet een afbeelding zijn.',
    'in' => 'The selected :attribute is ongeldig.',
    'in_array' => 'Het veld :attribute moet bestaan in :other.',
    'integer' => 'Het veld :attribute moet an integer  zijn.',
    'ip' => 'Het veld :attribute moet een geldig IP address zijn.',
    'ipv4' => 'Het veld :attribute moet een geldig IPv4 address zijn.',
    'ipv6' => 'Het veld :attribute moet een geldig IPv6 address zijn.',
    'json' => 'Het veld :attribute moet een geldig JSON string zijn.',
    'lowercase' => 'Het veld :attribute moet lowercase zijn.',
    'lt' => [
        'array' => 'Het veld :attribute moet minder dan :value items hebben.',
        'file' => 'Het veld :attribute moet minder dan :value kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet minder dan :value zijn.',
        'string' => 'Het veld :attribute moet kleiner zijn dan :value karakters.',
    ],
    'lte' => [
        'array' => 'Het veld :attribute mag niet meer dan :value items hebben.',
        'file' => 'Het veld :attribute moet minder zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'Het veld :attribute moet minder zijn dan of gelijk aan :value.',
        'string' => 'Het veld :attribute moet minder zijn dan of gelijk aan :value karakters.',
    ],
    'mac_address' => 'Het veld :attribute moet een geldig MAC address zijn.',
    'max' => [
        'array' => 'Het veld :attribute mag niet meer dan :max items hebben.',
        'file' => 'Het veld :attribute mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'Het veld :attribute mag niet groter zijn dan :max.',
        'string' => 'Het veld :attribute mag niet meer dan :max karakters bevatten.',
    ],
    'max_digits' => 'Het veld :attribute mag niet meer dan :max digits hebben.',
    'mimes' => 'Het veld :attribute moet een bestand zijn van type: :values.',
    'mimetypes' => 'Het veld :attribute moet een bestand zijn van type: :values.',
    'min' => [
        'array' => 'Het veld :attribute moet op zijn minst :min items hebben.',
        'file' => 'Het veld :attribute moet op zijn minst :min kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet op zijn minst :min zijn.',
        'string' => 'Het veld :attribute moet op zijn minst :min karakters bevatten.',
    ],
    'min_digits' => 'Het veld :attribute moet op zijn minst :min digits bevatten.',
    'missing' => 'Het veld :attribute moet ontbreken.',
    'missing_if' => 'Het veld :attribute moet ontbreken wanneer :other is :value.',
    'missing_unless' => 'Het veld :attribute moet ontbreken tenzij :other is :value.',
    'missing_with' => 'Het veld :attribute moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all' => 'Het veld :attribute moet ontbreken wanneer :values aanwezig zijn.',
    'multiple_of' => 'Het veld :attribute moet een veelvoud zijn van :value.',
    'not_in' => 'Het geselecteerde veld :attribute is ongeldig.',
    'not_regex' => 'Het veld :attribute formaat is ongeldig.',
    'numeric' => 'Het veld :attribute moet een nummer zijn.',
    'password' => [
        'letters' => 'Het veld :attribute moet minstens één letter bevatten.',
        'mixed' => 'Het veld :attribute moet minstens één hoofdletter en één kleine letter bevatten.',
        'numbers' => 'Het veld :attribute moet minstens één cijfer bevatten.',
        'symbols' => 'Het veld :attribute moet minstens één symbool bevatten.',
        'uncompromised' => 'Het gegeven :attribute is opgedoken in een datalek. Kies een ander :attribute.',
    ],
    'present' => 'Het veld :attribute moet aanwezig zijn.',
    'present_if' => 'Het veld :attribute moet aanwezig zijn wanneer :other is :value.',
    'present_unless' => 'Het veld :attribute moet aanwezig zijn tenzij :other is :value.',
    'present_with' => 'Het veld :attribute moet aanwezig zijn wanneer :values aanwezig is.',
    'present_with_all' => 'Het veld :attribute moet aanwezig zijn wanneer :values aanwezig zijn.',
    'prohibited' => 'Het veld :attribute is verboden.',
    'prohibited_if' => 'Het veld :attribute  is verboden wanneer :other is :value.',
    'prohibited_unless' => 'Het veld :attribute  is verboden tenzij :other is in :values.',
    'prohibits' => 'Het veld :attribute verbiedt :other van aanwezig te zijn.',
    'regex' => 'Het veld :attribute heeft een ongeldig formaat.',
    'required' => 'Het veld :attribute is verplicht.',
    'required_array_keys' => 'Het veld :attribute moet bevatten entries for: :values.',
    'required_if' => 'Het veld :attribute is verplicht wanneer :other is :value.',
    'required_if_accepted' => 'Het veld :attribute is verplicht wanneer :other is accepted.',
    'required_unless' => 'Het veld :attribute is verplicht tenzij :other is in :values.',
    'required_with' => 'Het veld :attribute is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Het veld :attribute is verplicht wanneer :values aanwezig zijn.',
    'required_without' => 'Het veld :attribute is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het veld :attribute  is verplicht wanneer geen enkele van :values aanwezig zijn.',
    'same' => 'Het veld :attribute moet identiek zijn aan :other.',
    'size' => [
        'array' => 'Het veld :attribute moet :size items bevatten.',
        'file' => 'Het veld :attribute moet :size kilobytes zijn.',
        'numeric' => 'Het veld :attribute moet :size zijn.',
        'string' => 'Het veld :attribute moet :size karakters bevatten.',
    ],
    'starts_with' => 'Het veld :attribute moet beginnen met een van de volgende: :values.',
    'string' => 'Het veld :attribute moet een string zijn.',
    'timezone' => 'Het veld :attribute moet een geldige tijdszone zijn.',
    'unique' => 'Het veld :attribute moet uniek zijn en is reeds gebruikt.',
    'uploaded' => 'Het veld :attribute kon niet geupload worden.',
    'uppercase' => 'Het veld :attribute moet in hoofdletters zijn.',
    'url' => 'Het veld :attribute moet een geldige URL zijn.',
    'ulid' => 'Het veld :attribute moet een geldige ULID zijn.',
    'uuid' => 'Het veld :attribute moet een geldige UUID zijn.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
