<?php

$config = [
    'id' => 'Sportforecast',
    'language'=>'ru-RU',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/modules/admin/views/layouts/admin',
            'controllerNamespace' => 'app\modules\admin\controllers\backend'
        ]
    ],
    'aliases' => [
        '@admin' => '@app/modules/admin/'
    ],
    'components' => [

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
