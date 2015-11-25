<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsBrand */

$this->title = Yii::t('goods-brand', 'Create Goods Brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('goods-brand', 'Goods Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-brand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
