<?php

namespace backend\modules\goods;
use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\goods\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
	{
	    \Yii::$app->getI18n()->translations['goods*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
            'fileMap' => [
                'goods-category' => 'goods-category.php',
                'goods-brand' => 'goods-brand.php',
            ],
        ];
	}
}
