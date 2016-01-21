<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\search\ArticleCategorySearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="article-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' =>['class' => 'well'],
    ]); ?>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'status')->dropdownList(ArticleCategory::getStatusArr()) ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(ArticleCategory::get(0, ArticleCategory::find()->where(['status'=>ArticleCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),
                    ['class' => 'form-control', 'prompt' => Yii::t('common', 'Please Filter')]) ?>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?= $form->field($model, 'title') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
