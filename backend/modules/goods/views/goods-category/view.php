<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-category','Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('goods-category','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('goods-category','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'name',
            'ico',
            'sort',
            'remark',
            [
                'attribute'=>'create_at',
                'value'=>date("Y-m-d H:i:s",$model->create_at),
            ],
            [
                'attribute'=>'create_by',
                'value'=>$model->creator ? $model->creator->username : "未设置" ,
            ],
            [
                'attribute'=>'update_at',
                'value'=>date("Y-m-d H:i:s",$model->update_at),
            ],
            [
                'attribute'=>'update_by',
                'value'=>$model->updator ? $model->updator->username : "未设置" ,
            ],
            [
                'attribute'=>'status',
                'value'=>$model::getStatusText($model->status),
            ],
        ],
    ]) ?>

</div>
