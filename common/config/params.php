<?php
return [
    'deliveryCity' => 'Istočno Sarajevo',
    'deliveryCountry' => 'BA',
    'currency' => 'BAM',
    'tax' => 17,
    'minOrderTotalAmount' => 4,
    'businessDays' => [0, 1, 2, 3, 4, 5, 6],
    'businessHours' => [
        'from' => 8,
        'to' => 22
    ],
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'pattern' => [
        'letter' => '/[a-zA-Z]/',
        'digit' => '/[0-9]/',
        'specialChar' => '/[^A-Za-z0-9\s]/'
    ],
    'orderNoPrefix' => 'ORD-',
    'resourceManager' => [
        's3.path.prefix' => 'local',
        's3.file.prefix' => '',
        'image.thumb.path' => 'thumbs/', //relative from path prefix
        's3.expire.time' => '+20 minutes',
        'image.thumb.expire' => '+20 minutes'
    ],

    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
];
