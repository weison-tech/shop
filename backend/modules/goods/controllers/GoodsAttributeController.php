<?php

namespace backend\modules\goods\controllers;

use Yii;
use common\models\GoodsAttributeName;
use common\models\GoodsAttributeValue;
use backend\modules\goods\models\search\GoodsAttributeNameSearch;
use backend\modules\goods\models\search\GoodsAttributeValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsAttributeNameController implements the CRUD actions for GoodsAttributeName model.
 */
class GoodsAttributeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'deleteRoute' => 'upload-delete'
            ],
            'upload-delete' => [
                'class' => 'trntv\filekit\actions\DeleteAction'
            ],
            'upload-imperavi' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'fileparam' => 'file',
                'responseUrlParam'=> 'filelink',
                'multiple' => false,
                'disableCsrf' => true
            ],
        ];
    }

    /**
     * Lists all GoodsAttributeName models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsAttributeNameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoodsAttributeName model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new GoodsAttributeValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new GoodsAttributeName model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsAttributeName();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GoodsAttributeName model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GoodsAttributeName model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model->status = GoodsAttributeName::STATUS_DELETED;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Batch delete existing GoodsAttributeName models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBatchDelete()
    {
        $ids = Yii::$app->request->post('ids');
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $model = $this->findModel($id);
                $model->status = GoodsAttributeName::STATUS_DELETED;
                $model->save();
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * create the value of the attribute name
     */
    public function actionCreateValue()
    {
        $model = new GoodsAttributeValue();
        $model->attribute_name_id = $_GET['name_id'];
        $params = Yii::$app->request->post();
        if ($model->load($params) && $model->save()) {
            if(isset($params['createMore']) && $params['createMore']){ //create and continure open create form
                Yii::$app->session->setFlash('create_success',Yii::t('goods-attribute', 'Attribute value has been created.'));
                return $this->redirect(['create-value', 'name_id' => $model->attribute_name_id]);
            }else{
                return $this->redirect(['view', 'id' => $model->attribute_name_id]);
            }
        } else {
            return $this->render('create-value', [
                'model' => $model,
            ]);
        }
    }

    /**
     * create the value of the attribute name
     */
    public function actionUpdateValue($id)
    {
        $model = $this->findValueModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->attribute_name_id]);
        } else {
            return $this->render('update-value', [
                'model' => $model,
            ]);
        }
    }

    /**
     * view the value of the attribute name
     */
    public function actionViewValue($id)
    {
        $model = $this->findValueModel($id);
        return $this->render('view-value', [
            'model' => $model,
        ]);
    }

    /**
     * view the value of the attribute name
     */
    public function actionDeleteValue($id)
    {
        $model = $this->findValueModel($id);
        $attribute_name_id = $model->attribute_name_id;
        $model->status = GoodsAttributeValue::STATUS_DELETED;
        $model->save();
        return $this->redirect(['view?id='.$attribute_name_id]);
    }

    /**
     * Batch delete existing GoodsAttributeName models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBatchDeleteValue()
    {
        $ids = Yii::$app->request->post('ids');
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $model = $this->findValueModel($id);
                $model->status = GoodsAttributeValue::STATUS_DELETED;
                $model->save();
            }
        }

        return $this->redirect(['view?id='.$_GET['id']]);
    }

    /**
     * Finds the GoodsAttributeName model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GoodsAttributeName the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsAttributeName::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findValueModel($id)
    {
        if (($model = GoodsAttributeValue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
