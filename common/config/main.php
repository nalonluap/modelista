<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'imageOptimizer' => [
            'class' => 'common\components\ImageOptimizer',
        ],
        'instagram' => [
            'class' => 'common\components\Instagram',
            'clientId' => '547457273104837',
            'clientSecret' => 'a585fc23b265467a0ec880e8542efc9d',
            'redirectUri' => 'https://modelista.ru/instagram/token',
        ],
    ],
];
