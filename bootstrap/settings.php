<?php
return [
    'displayErrorDetails' => true,
    'app'                 => [
        'name' => 'slim-auth',
    ],
    'mail'                => [
        'host'     => getenv('MAIL_HOST'),
        'port'     => getenv('MAIL_PORT'),
        'from'     => [
            'address' => getenv('MAIL_FROM_ADDRESS'),
            'name'    => getenv('MAIL_FROM_NAME'),
        ],
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
    ],
];