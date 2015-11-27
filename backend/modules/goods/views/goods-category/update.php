<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = Yii::t('goods-category','Update Goods Category: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-category','Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="goods-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
