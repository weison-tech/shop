<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use common\models\GoodsAttributeValue;
use yii\bootstrap\Alert;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsAttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-attribute-value-form">

    <?php
        if(Yii::$app->session->hasFlash('create_success')){
            Alert::begin([
            'options' => [
            'class' => 'alert-success',
            ],
            ]);
            echo Yii::$app->session->getFlash('create_success');
            Alert::end();
        }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'ico')->widget(
        Upload::className(),
        [
            'url' => ['upload'],
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->dropdownList(GoodsAttributeValue::getStatusArr()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('goods-attribute', 'Create') : Yii::t('goods-attribute', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if($model->isNewRecord){?>
            <input id="createMore" name="createMore" type="hidden" />
            <?= Html::submitButton(Yii::t('goods-attribute', 'Create and coninue'), ['class' => 'btn btn-primary','onclick'=>'return continueCreate()']) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
    function continueCreate(){
        $("#createMore").val("true");
        return true;
    }
JS;
$this->registerJs($js, \yii\web\View::POS_END);
