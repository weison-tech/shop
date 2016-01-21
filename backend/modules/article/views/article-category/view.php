<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use common\widgets\DetailView4Col as DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Article Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-view">

    <p>
        <?= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
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
                'attribute' => 'parent_id',
                'value'=>$model->parent ? $model->parent->title : '-',
            ],
            'title',
            'slug',
            [
                'attribute'=>'created_at',
                'value'=>date("Y-m-d H:i:s",$model->created_at),
            ],
            [
                'attribute'=>'updated_at',
                'value'=>date("Y-m-d H:i:s",$model->updated_at),
            ],
            [
                'attribute'=>'status',
                'value'=>$model::getStatusText($model->status),
            ],
        ],
    ]) ?>

</div>
