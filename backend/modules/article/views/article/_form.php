<?php

use trntv\filekit\widget\Upload;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $categories common\models\ArticleCategory[] */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => true])
    ?>

    <?php
        echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            $categories,
            'id',
            'title'
        ), ['prompt'=>''])
    ?>

    <?php
        echo $form->field($model, 'body')->widget(
        \yii\imperavi\Widget::className(),
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                'minHeight' => 400,
                'maxHeight' => 400,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => false,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/article/article/upload-imperavi'])
            ]
        ]
        )
    ?>

    <?php
        echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?php
        echo $form->field($model, 'attachments')->widget(
        Upload::className(),
        [
            'url' => ['upload'],
            'sortable' => true,
            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 10
        ]);
    ?>

    <?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <?php
        if($model->published_at){
            $model->published_at = date('Y-m-d H:i:s',$model->published_at);
        }else{
            $model->published_at = date('Y-m-d H:i:s');
        }
        echo $form->field($model, 'published_at')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => yii::t('backend','Published Time ...')],
            'pluginOptions' => [
                'autoclose' => true,
                'pickerPosition' => 'top-right',
            ]
        ]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
