<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use common\models\GoodsCategory;
use common\models\GoodsBrand;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsBrand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(GoodsCategory::get(0, GoodsCategory::find()->where(['status'=>GoodsCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),['class' => 'form-control', 'prompt' => Yii::t('goods-category', 'Please Filter')]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'logo')->widget(
        Upload::className(),
        [
            'url' => ['upload'],
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList(GoodsBrand::getStatusArr()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('goods-brand', 'Create') : Yii::t('goods-brand', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
