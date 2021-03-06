<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 17.01.2017
 * Time: 11:50
 */
use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'Сайт спортивных прогнозов',
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
    ],
    'basePath' => dirname(__DIR__),
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];