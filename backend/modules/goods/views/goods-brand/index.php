<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
        <?= Html::a(Yii::t('goods-brand', 'Batch Delete'), 'javascript:void(0);', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

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

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'label'=>Yii::t('common','Operation'),
                'format'=>'raw',
                'value' => function($data){
                    $viewUrl = Url::to(['view?id='.$data->id]);
                    $updateUrl = Url::to(['update?id='.$data->id]);
                    $deleteUrl = Url::to(['delete?id='.$data->id]);
                    return "<div class='btn-group'>".
                    Html::a(Yii::t('common','View'), $viewUrl, ['title' => Yii::t('common','View'),'class'=>'btn btn-sm btn-info']).
                    Html::a(Yii::t('common','Update'), $updateUrl, ['title' => Yii::t('common','Update'),'class'=>'btn btn-sm btn-primary']).
                    Html::a(Yii::t('common','Delete'), $deleteUrl, ['title' => Yii::t('common','Delete'),'class'=>'btn btn-sm btn-danger','data-method'=>'post', 'data-confirm'=>Yii::t('common','Are you sure to delete ?')]).
                    "</div>";
                }
            ]
        ],
    ]); ?>

</div>

<?php
$urlBatchDelete = \yii\helpers\Url::to(['/goods/goods-brand/batch-delete']);
$message = Yii::t('common','Are you sure to batch delete?');
$confirmBtn = Yii::t('common','Ok');
$cancleBtn = Yii::t('common','Cancle');
$js = <<<JS
jQuery(document).ready(function() {
    $("#batchDelete").click(function() {
        bootbox.confirm(
            {
                message: "{$message}",
                buttons: {
                    confirm: {
                        label: "{$confirmBtn}"
                    },
                    cancel: {
                        label: "{$cancleBtn}"
                    }
                },
                callback: function (confirmed) {
                    if (confirmed) {
                        var keys = $("#w0").yiiGridView("getSelectedRows");
                        $.ajax({
                            type: "POST",
                            url: "{$urlBatchDelete}",
                            dataType: "json",
                            data: {ids: keys}
                        });
                    }
                }
            }
        );
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);