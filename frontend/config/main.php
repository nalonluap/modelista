<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                  'pattern' => 'model/set-notification',
                  'route' => 'model/set-notification',
                ],
                [
                  'pattern' => 'model/get-contacts',
                  'route' => 'model/get-contacts',
                ],
                [
                  'pattern' => 'model/send-request',
                  'route' => 'model/send-request',
                ],
                [
                  'pattern' => 'model/<id>',
                  'route' => 'model/index',
                ],
                [
                  'pattern' => 'photographer/<id>',
                  'route' => 'photographer/index',
                ],
                '' => 'site/index',
                'compress' => 'site/compress',
                'load-all-images' => 'site/load-all-images',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
