<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-store',
    'name' => '店铺管理后台',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'store\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            // following line will restrict access to admin page
            'as store' => 'dektrium\user\filters\BackendFilter',
            'enablePasswordRecovery' => false,
        ],
        'goods' => [
            'class' => 'store\modules\goods\Module',
        ],
    ],
    'components' => [
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
        'authManager' => [
            'class'=> 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
    'as layoutFilter' => [
        'class' => 'store\behaviors\LayoutBehavior',
    ],
    //rbac 权限控制
    'as access' => [
        'class' => 'mdm\admin\classes\AccessControl',
        'allowActions' => [
            'site/*',
            'rbac/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
];
