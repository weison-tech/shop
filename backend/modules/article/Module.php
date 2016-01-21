<?php

namespace backend\modules\article;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\article\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        \Yii::$app->getI18n()->translations['article*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
            'fileMap' => [
                'article-category' => 'article-category.php',
            ],
        ];
    }
}
