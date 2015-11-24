<?php

namespace backend\modules\system\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\system\models\search\TimelineEventSearch;

/**
 * Application timeline controller
 */
class TimelineEventController extends Controller
{
    /**
     * Lists all TimelineEvent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimelineEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
