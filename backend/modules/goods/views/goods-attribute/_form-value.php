<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use common\models\GoodsAttributeValue;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-attribute-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'ico')->widget(
        Upload::className(),
        [
            'url' => ['upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->dropdownList(GoodsAttributeValue::getStatusArr()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('goods-attribute', 'Create') : Yii::t('goods-attribute', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
