<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeValue */

$this->title = Yii::t('goods-attribute', 'Update Goods Attribute Value: ', [
    'modelClass' => 'Goods Attribute Value',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute', 'Goods Attribute Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('goods-attribute', 'Update');
?>
<div class="goods-attribute-value-update">

    <?= $this->render('_form-value', [
        'model' => $model,
    ]) ?>

</div>
