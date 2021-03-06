<?php
namespace store\controllers;

use yii\web\Controller;
use common\components\keyStorage\FormModel;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['/user/login']);
        }
        return $this->render('index');
    }

    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('store', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('store', 'Disabled'),
                        'enabled' => Yii::t('store', 'Enabled')
                    ]
                ],
                'store.theme-skin' => [
                    'label' => Yii::t('store', 'Store theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'store.layout-fixed' => [
                    'label' => Yii::t('store', 'Fixed store layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'store.layout-boxed' => [
                    'label' => Yii::t('store', 'Boxed store layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'store.layout-collapsed-sidebar' => [
                    'label' => Yii::t('store', 'Store sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('store', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }
        return $this->render('settings', ['model' => $model]);
    }
}
