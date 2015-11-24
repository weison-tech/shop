<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=shop',
            'username' => 'root',
            'password' => 'Xiaoma007',
            'charset' => 'utf8',
            'tablePrefix' => 'ms_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => 'xiaoma_1102@163.com',
                'password' => 'xiaoma007',
                'port' => '994',
                'encryption' => 'ssl',
            ],
        ],
    ],
];
