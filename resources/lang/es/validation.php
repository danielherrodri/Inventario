<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe aceptarse cuando :other es :value.',
    'active_url' => 'El campo :attribute no es una URL válida',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute debe contener solamente letras.',
    'alpha_dash' => 'El campo :attribute debe contener unicamente letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute debe contener unicamente números y letras.',
    'array' => 'El campo :attribute debe ser un arreglo.',
    'before' => 'El campo :attribute debe ser una fecha anterior :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file' => 'El archivo :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe estar entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe contener unicamente false o true.',
    'confirmed' => 'El campo :attribute la confirmación no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El campo :attribute no corresponde con una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'declined' => 'El campo :attribute debe ser rechazado.',
    'declined_if' => 'El campo :attribute debe ser rechazado cuando :other es :value.',
    'different' => 'El campo :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute solo debe contener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'ends_with' => 'El campo :attribute debe finalizar con alguno de los siguientes valores: :values',
    'enum' => 'El campo :attribute es inválido.',
    'exists' => 'El campo :attribute seleccionado no existe.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => "El campo :attribute es obligatorio.",
    'gt' => [
        'numeric' => "El campo :attribute debe ser mayor que :value.",
        'file' => "El campo :attribute debe tener más de :value kilobytes.",
        'string' => "El campo :attribute debe tener más de :value caracteres.",
        'array' => "El campo :attribute debe tener más de :value elementos.",
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file' => "El campo :attribute debe tener como mínimo :value kilobytes.",
        'string' => "El campo :attribute debe tener más de :value caracteres.",
        'array' => "El campo :attribute debe tener como mínimo :value elementos.",
    ],
    'image' => 'El campo :attribute debe contener una imagen.',
    'in' => 'El campo :attribute seleccionado es inválido.',
    'in_array' => "El campo :attribute no existe en :other.",
    'integer' => 'El campo :attribute debe contener números enteros.',
    'ip' => 'El campo :attribute debe tener una dirección IP válida.',
    'ipv4' =>  "El campo :Attribute debe ser una dirección IPv4 válida.",
    'ipv6' => "El campo :Attribute debe ser una dirección IPv6 válida.",
    'json' => 'El campo :attribute debe contener un formato JSON válido.',
    'lt' => [
        'numeric' =>  "El campo :attribute debe ser menor que :value.",
        'file' => "El campo :attribute debe tener menos de :value kilobytes.",
        'string' => "El campo :attribute debe tener menos de :value caracteres.",
        'array' =>  "El campo :attribute debe tener menos de :value elementos.",
    ],
    'lte' => [
        'numeric' => "El campo :attribute debe ser como máximo :value.",
        'file' => "El campo :attribute debe tener como máximo :value kilobytes.",
        'string' => 'El campo :attribute debe ser menor o igual a :value caracteres.',
        'array' => "El campo :attribute debe tener como máximo :value elementos.",
    ],
    'mac_address' => "El campo :attribute debe ser una dirección MAC válida.",
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file' => 'El campo :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El campo :attribute no debe contener más de :max caracteres.',
        'array' => 'El campo :attribute no debe tener más de :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'El campo :attribute debe estar en los siguientes tipos: :values.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser de al menos :min.',
        'file' => 'El campo :attribute debe contener al menos :min kilobytes.',
        'string' => 'El campo :attribute debe contener por lo menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos :min items.',
    ],
    'multiple_of' => "El campo :attribute debe ser múltiplo de :value",
    'not_in' => "El campo :Attribute es inválido.",
    'not_regex' => "El formato del campo :attribute no es válido.",
    'numeric' => "El campo :Attribute debe ser numérico.",
    'password' => "La contraseña es incorrecta.",
    'present' =>  "El campo :attribute debe estar presente.",
    'prohibited' =>  "El campo :attribute está prohibido.",
    'prohibited_if' => "El campo :attribute está prohibido cuando :other es :value.",
    'prohibited_unless' => "El campo :attribute está prohibido a menos que :other sea :values.",
    'prohibits' => "El campo :attribute prohibe que :other esté presente.",
    'regex' => "El formato de :attribute es inválido.",
    'required' =>  "El campo :attribute es obligatorio.",
    'required_array_keys' =>  "El campo :attribute debe contener entradas para: :values.",
    'required_if' =>  "El campo :attribute es obligatorio cuando :other es :value.",
    'required_unless' => "El campo :attribute es obligatorio a menos que :other esté en :values.",
    'required_with' => "El campo :attribute es obligatorio cuando :values está presente.",
    'required_with_all' => "El campo :attribute es obligatorio cuando :values están presentes.",
    'required_without' => "El campo :attribute es obligatorio cuando :values no está presente.",
    'required_without_all' => "El campo :attribute es obligatorio cuando ninguno de :values está presente.",
    'same' => 'El campo :attribute y el campo :other deben coincidir.',
    'size' => [
        'numeric' => 'El campo :attribute debe tener como máximo :size.',
        'file' => 'El campo :attribute debe tener :size kilobytes.',
        'string' => 'El campo :attribute debe contener :size caracteres.',
        'array' => 'El campo :attribute debe contener :size items.',
    ],
    'starts_with' => 'El campo :attribute debe empezar con uno de los siguientes valores: :values.',
    'string' => 'El campo :attribute debe ser texto.',
    'timezone' => "El campo :Attribute debe ser una zona horaria válida.",
    'unique' => "El campo :attribute ya ha sido registrado.",
    'uploaded' => 'El campo :attribute falló al subir.',
    'url' => "El campo :Attribute debe ser una URL válida.",
    'uuid' => "El campo :attribute debe ser un UUID válido.",

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
