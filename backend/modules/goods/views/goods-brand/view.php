<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsBrand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-brand', 'Goods Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-brand-view">


    <p>
        <?= Html::a(Yii::t('goods-brand', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('goods-brand', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('goods-brand', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
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
                'attribute'=>'logo',
                'value'=>$model->logo_base_url."/".$model->logo_path,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'sort',
            'description',
            [
                'attribute'=>'created_at',
                'value'=>date("Y-m-d H:i:s",$model->created_at),
            ],
            [
                'attribute'=>'created_by',
                'value'=>$model->creator ? $model->creator->username : "未设置" ,
            ],
            [
                'attribute'=>'updated_at',
                'value'=>date("Y-m-d H:i:s",$model->updated_at),
            ],
            [
                'attribute'=>'updated_by',
                'value'=>$model->updator ? $model->updator->username : "未设置" ,
            ],
            [
                'attribute'=>'status',
                'value'=>$model::getStatusText($model->status),
            ],
        ],
    ]) ?>

</div>
