<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'metadocument' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=metadocu_dbdocument',
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