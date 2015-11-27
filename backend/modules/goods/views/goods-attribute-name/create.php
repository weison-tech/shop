<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeName */

$this->title = Yii::t('goods-attribute-name', 'Create Goods Attribute Name');
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-attribute-name', 'Goods Attribute Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-name-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
