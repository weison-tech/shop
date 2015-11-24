<?php
namespace api\versions\v1\controllers;

use common\models\Article;
use yii\data\ActiveDataProvider;
use api\common\BaseController;
use yii\filters\auth\QueryParamAuth;

/**
 * @author xiaoma <xiaomalover@gmail.com>
 * @since 2.0
 */
class ArticleController extends BaseController
{
    public $modelClass = 'api\models\Article';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function actions()
    {
        return array_merge(
            parent::actions(),
            [
                'index' => [
                    'class' => 'api\versions\v1\actions\ArticleIndexAction',
                    'modelClass' => $this->modelClass,
                    'checkAccess' => [$this, 'checkAccess'],
                ]
            ]
        );
    }
}
