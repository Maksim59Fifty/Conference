<?php

return [
    'required'  => 'Laukas :attribute yra privalomas.',
    'email'     => 'Laukas :attribute turi būti galiojantis el. pašto adresas.',
    'min'       => [
        'string' => 'Laukas :attribute turi būti bent :min simbolių.',
    ],
    'max'       => [
        'string' => 'Laukas :attribute negali būti ilgesnis nei :max simbolių.',
    ],
    'unique'    => 'Šis :attribute jau naudojamas.',
    'confirmed' => 'Laukai :attribute nesutampa.',
    'date'      => 'Laukas :attribute turi būti galiojanti data.',
    'string'    => 'Laukas :attribute turi būti tekstas.',

    'attributes' => [
        'first_name'            => 'vardas',
        'last_name'             => 'pavardė',
        'email'                 => 'el. pašto adresas',
        'password'              => 'slaptažodis',
        'password_confirmation' => 'slaptažodžio patvirtinimas',
        'title'                 => 'pavadinimas',
        'description'           => 'aprašymas',
        'lecturers'             => 'lektoriai',
        'date'                  => 'data',
        'time'                  => 'laikas',
        'address'               => 'adresas',
    ],
];
