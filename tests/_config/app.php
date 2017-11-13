<?php
return [
    'id' => 'test-app',
    'class' => \yii\console\Application::class,

    'basePath' => Yii::getAlias('@tests'),
    'vendorPath' => Yii::getAlias('@vendor'),
    'runtimePath' => Yii::getAlias('@tests/_output'),

    'bootstrap' => [],

    'aliases' => [
        '@webroot/uploads/banners' => '@data/files',
    ],

    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'sqlite:' . Yii::getAlias('@tests/_output/test.db'),
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],

    'container' => [
        'definitions' => [
            \ymaker\banner\common\components\FileManagerInterface::class =>
            \ymaker\banner\common\components\FileManager::class,
        ],
    ],
];