<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeValue */

$this->title = Yii::t('goods-attribute', 'Create Goods Attribute Value');
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute', 'Goods Attribute Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-value-create">

    <?= $this->render('_form-value', [
        'model' => $model,
    ]) ?>

</div>
