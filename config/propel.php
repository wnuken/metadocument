<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'metadocument' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=metadocument',
                    'user'       => 'developer',
                    'password'   => 'developer',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'metadocument',
            'connections' => ['metadocument']
        ],
        'generator' => [
            'defaultConnection' => 'metadocument',
            'connections' => ['metadocument']
        ]
    ]
];