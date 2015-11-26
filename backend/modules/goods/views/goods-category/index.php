<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\GoodsCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\goods\models\search\GoodsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goods-category', 'Goods Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goods-category','Create Goods Category'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('goods-brand', 'Batch Delete'), 'javascript:void(0);', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            [
                'attribute' => 'parent_id',
                'value'=>function ($model) {
                    return $model->parent ? $model->parent->name : '-';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_id',
                    ArrayHelper::map(GoodsCategory::get(0, GoodsCategory::find()->where(['status'=>GoodsCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),
                    ['class' => 'form-control', 'prompt' => Yii::t('goods-category', 'Please Filter')]
                ),
            ],
            'name',
            [
                'attribute' => 'ico_path',
                'content'=>function($model){
                    return Html::img($model->ico_base_url."/".$model->ico_path,['style'=>'width:100px;height:100px;']);
                },
            ],
            'sort',
            [
                'attribute' => 'created_at',
                'value'=>function($model){
                    return date("Y-m-d H:i:s",$model->created_at);
                },
            ],
            [
                'attribute'=>'created_person',
                'value' => 'creator.username',
            ],

            [
                'attribute' => 'status',
                'value'=>function($model){
                    return GoodsCategory::getStatusText($model->status);
                },
                'filter' => GoodsCategory::getStatusArr(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php
$urlBatchDelete = \yii\helpers\Url::to(['/goods/goods-category/batch-delete']);
$js = <<<JS
jQuery(document).ready(function() {
    $("#batchDelete").click(function() {
        var keys = $("#w0").yiiGridView("getSelectedRows");
        $.ajax({
            type: "POST",
            url: "{$urlBatchDelete}",
            dataType: "json",
            data: {ids: keys}
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
