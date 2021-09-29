<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/swagger',
        'pluralize' => false,
        'patterns' => [
            'GET' => 'docs',
            'GET index' => 'docs',
            'GET json-schema' => 'json-schema',
            'OPTIONS <action>' => 'options',
            '' => 'options',
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/oauth',
        'pluralize' => false,
        'patterns' => [
            'POST token' => 'token',
            'POST revoke' => 'revoke',
            'OPTIONS <action>' => 'options',
            '' => 'options',
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/user',
        'pluralize' => false,
        'patterns' => [
            'GET info' => 'info',
            'POST register' => 'register',
            'PUT update-info' => 'update',
            'OPTIONS <action>' => 'options',
            '' => 'options',
        ],
    ]
];
