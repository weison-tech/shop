<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = Yii::t('goods-category','Create Goods Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-category','Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
