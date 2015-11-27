<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeName */

$this->title = Yii::t('goods-attribute-name', 'Update Goods Attribute Name: ', [
    'modelClass' => 'Goods Attribute Name',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute-name', 'Goods Attribute Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('goods-attribute-name', 'Update');
?>
<div class="goods-attribute-name-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
