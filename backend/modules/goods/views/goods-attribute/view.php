<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\GoodsAttributeValue;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeName */

$this->title = Yii::t('goods-attribute', 'Attribute : ').$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute', 'Goods Attribute Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-name-view">


    <p>
        <?= Html::a(Yii::t('goods-attribute', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('goods-attribute', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('goods-attribute', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('common','Back to list'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value'=>$model->category ? $model->category->name : '-',
            ],
            'name',
            [
                'attribute'=>'is_sku_attribute',
                'value'=>$model::getIsSkuText($model->status),
            ],
            'remark',
            'sort',
            [
                'attribute'=>'created_at',
                'value'=>date("Y-m-d H:i:s",$model->created_at),
            ],
            [
                'attribute'=>'created_by',
                'value'=>$model->creator ? $model->creator->username : "-" ,
            ],
            [
                'attribute'=>'updated_at',
                'value'=>date("Y-m-d H:i:s",$model->updated_at),
            ],
            [
                'attribute'=>'updated_by',
                'value'=>$model->updator ? $model->updator->username : "-" ,
            ],
            [
                'attribute'=>'status',
                'value'=>$model::getStatusText($model->status),
            ],
        ],
    ]) ?>

    

</div>


<h3><?=Yii::t('goods-attribute','Goods Attribute value list')?></h3>
<div class="goods-attribute-value-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goods-attribute', 'Create Goods Attribute Value'), ['create-value?name_id='.$model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('goods-brand', 'Batch Delete'), 'javascript:void(0);', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'name',
            [
                'attribute' => 'ico_path',
                'content'=>function($model){
                    return $model->ico_path ? Html::img($model->ico_base_url."/".$model->ico_path,['style'=>'width:100px;height:100px;']) : '-';
                },
            ],
            'sort',
            [
                'attribute' => 'status',
                'value'=>function($model){
                    return GoodsAttributeValue::getStatusText($model->status);
                },
                'filter' => GoodsAttributeValue::getStatusArr(),
            ],

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'label'=>Yii::t('common','Operation'),
                'format'=>'raw',
                'value' => function($data){
                    $viewUrl = Url::to(['view-value?id='.$data->id]);
                    $updateUrl = Url::to(['update-value?id='.$data->id]);
                    $deleteUrl = Url::to(['delete-value?id='.$data->id]);
                    return "<div class='btn-group'>".
                    Html::a(Yii::t('common','View'), $viewUrl, ['title' => Yii::t('common','View'),'class'=>'btn btn-sm btn-info']).
                    Html::a(Yii::t('common','Update'), $updateUrl, ['title' => Yii::t('common','Update'),'class'=>'btn btn-sm btn-primary']).
                    Html::a(Yii::t('common','Delete'), $deleteUrl, ['title' => Yii::t('common','Delete'),'class'=>'btn btn-sm btn-danger','data-method'=>'post', 'data-confirm'=>Yii::t('common','Are you sure you want to delete this item?')]).
                    "</div>";
                },
                'options' => ['style' => 'width:175px;'],
            ]
        ],
    ]); ?>

</div>


<?php
$urlBatchDelete = \yii\helpers\Url::to(['/goods/goods-attribute/batch-delete-value?id='.$_GET['id']]);
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
                        var keys = $(".grid-view").yiiGridView("getSelectedRows");
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