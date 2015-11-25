<?php
return [
	'language' => 'zh-CN',
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],

		'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix'=>function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

		'authClientCollection' => [
			    'class' => yii\authclient\Collection::className(),
			    'clients' => [
			        'facebook' => [
			            'class'        => 'dektrium\user\clients\Facebook',
			            'clientId'     => 'CLIENT_ID',
			            'clientSecret' => 'CLIENT_SECRET',
			        ],
			        'twitter' => [
			            'class'          => 'dektrium\user\clients\Twitter',
			            'consumerKey'    => 'CONSUMER_KEY',
			            'consumerSecret' => 'CONSUMER_SECRET',
			        ],
			        'google' => [
			            'class'        => 'dektrium\user\clients\Google',
			            'clientId'     => 'CLIENT_ID',
			            'clientSecret' => 'CLIENT_SECRET',
			        ],
			        'github' => [
				'class'        => 'dektrium\user\clients\GitHub',
				'clientId'     => 'CLIENT_ID',
				'clientSecret' => 'CLIENT_SECRET',
			         ],
			],
		],

		'urlManager' => [
		    'enablePrettyUrl' => true,
		    'showScriptName' => false,
		    'rules' => [
		    ],
		],

		'keyStorage' => [
            'class' => 'common\components\keyStorage\KeyStorage'
        ],

		'i18n' => [
            'translations' => [
                'app'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                ],
                '*'=> [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                    'fileMap'=>[
                        'common'=>'common.php',
                        'backend'=>'backend.php',
                        'frontend'=>'frontend.php',
                    ],
                    //'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
                ],
            ],
        ],

        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => 'http://storage.itweshare.com/uploads',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@storage/uploads'
            ],
            'as log' => [
                'class' => 'common\behaviors\FileStorageLogBehavior',
                'component' => 'fileStorage'
            ]
        ],

	],

	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'admins' => ['admin'],
		],
	],

	'as locale' => [
        'class' => 'common\behaviors\LocaleBehavior',
    ],
];
