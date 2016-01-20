<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use common\widgets\DetailView4Col as DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeValue */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute', 'Goods Attribute Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-value-view">


    <p>
        <?= Html::a(Yii::t('goods-attribute', 'Update'), ['update-value', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('goods-attribute', 'Delete'), ['delete-value', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('goods-attribute', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('common','Back to list'), ['view?id='.$model->attribute_name_id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'attribute_name_id',
                'value'=>$model->attributeName ? $model->attributeName->name : "-" ,
            ],
            'name',
            'sort',
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
            [
                'attribute'=>'ico',
                'value'=>$model->ico_path ? \Yii::$app->fileStorage->baseUrl."/".$model->ico_path : '-',
                'format' => [$model->ico_path ? 'image' : 'text', ['width'=>'100','height'=>'100']],
            ],
        ],
    ]) ?>

</div>
