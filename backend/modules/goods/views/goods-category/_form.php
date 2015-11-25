<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\GoodsCategory;
use trntv\filekit\widget\Upload;
/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(GoodsCategory::get(0, GoodsCategory::find()->asArray()->all()), 'id', 'label'),['class' => 'form-control', 'prompt' => Yii::t('goods-category', 'Please Filter')]) ?>

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

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(GoodsCategory::getStatusArr()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('goods-category','Create') : Yii::t('goods-category','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
