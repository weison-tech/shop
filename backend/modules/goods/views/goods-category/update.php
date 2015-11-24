<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = Yii::t('goods-category','Update Goods Category: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-category','Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('goods-category','Update');
?>
<div class="goods-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
