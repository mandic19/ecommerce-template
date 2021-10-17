<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mariadb;dbname=ecommerce_template_local',
            'username' => 'root',
            'password' => 'password1996',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'resourceManager' => [
            'class' => 'common\components\FileSystemResourceManager',
            'basePath' => '../../storage_aws_s3',
        ]
    ],
];
