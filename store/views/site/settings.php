<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
$this->title = Yii::t('store', 'Application settings');
?>
<div class="box">
    <div class="box-body">
        <?php echo \common\components\keyStorage\FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('store', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary']
        ]); ?>
    </div>
</div>

