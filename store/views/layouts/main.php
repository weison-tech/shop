<?php
use store\assets\storeAsset;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = storeAsset::register($this);

$this->params['body-class'] = array_key_exists('body-class', $this->params) ?
    $this->params['body-class']
    : null;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<?php echo Html::beginTag('body', [
    'class' => implode(' ', [
        ArrayHelper::getValue($this->params, 'body-class'),
        Yii::$app->keyStorage->get('store.theme-skin', 'skin-blue'),
        Yii::$app->keyStorage->get('store.layout-fixed') ? 'fixed' : null,
        Yii::$app->keyStorage->get('store.layout-boxed') ? 'layout-boxed' : null,
        Yii::$app->keyStorage->get('store.layout-collapsed-sidebar') ? 'sidebar-collapse' : null,
    ])
])?>
    <?php $this->beginBody() ?>
        <br/><br/><br/><br/>
        <div class="container">
            <?php echo $content ?>
        </div>
    <?php $this->endBody() ?>
<?php echo Html::endTag('body') ?>
</html>
<?php $this->endPage() ?>