<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\GoodsCategory;

/* @var $this yii\web\View */
/* @var $model backend\modules\goods\models\search\GoodsCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' =>['class' => 'well'],
    ]); ?>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(GoodsCategory::get(0, GoodsCategory::find()->where(['status'=>GoodsCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),
                    ['class' => 'form-control', 'prompt' => Yii::t('goods-category', 'Please Filter')]) ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?php
            echo '<label class="control-label">'.Yii::t('common','Create Time').'</label>';
            echo DatePicker::widget([
                'name' => 'create_from_date',
                'value' => date('Y-m-d'),
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'create_to_date',
                'value2' => date('Y-m-d'),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-m-dd'
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'sort') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'remark') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'created_by') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'status') ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
