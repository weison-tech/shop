<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\GoodsCategory;
use common\models\GoodsBrand;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\goods\models\search\GoodsBrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goods-brand', 'Goods Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-brand-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goods-brand', 'Create Goods Brand'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'category_search',
                'value' => 'category.name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    ArrayHelper::map(GoodsCategory::get(0, GoodsCategory::find()->where(['status'=>GoodsCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),
                    ['class' => 'form-control', 'prompt' => Yii::t('goods-category', 'Please Filter')]
                ),
            ],
            'name',
            [
                'attribute' => 'logo_path',
                'content'=>function($model){
                    return Html::img($model->logo_base_url."/".$model->logo_path,['style'=>'width:100px;height:100px;']);
                },
            ],
            'sort',
            // 'description',
[
            'attribute' => 'status',
                'value'=>function($model){
                    return GoodsBrand::getStatusText($model->status);
                },
                'filter' => GoodsBrand::getStatusArr(),
            ],
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
