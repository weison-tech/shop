<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsBrand */

$this->title = Yii::t('goods-brand', 'Update {modelClass}: ', [
    'modelClass' => 'Goods Brand',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-brand', 'Goods Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('goods-brand', 'Update');
?>
<div class="goods-brand-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
