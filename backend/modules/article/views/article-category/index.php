<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\ArticleCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\\models\search\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <div id="advanced-search-form" style="display: none;"><?php echo $this->render('_search', ['model' => $searchModel]); ?></div>

    <p>
        <?= Html::a(Yii::t('article-category','Create Article Category'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Batch Delete'), 'javascript:void(0);', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
        <?= Html::a(Yii::t('common', 'Advanced Search'), 'javascript:void(0);', ['class' => 'btn btn-info', 'id' => 'search']) ?>
    </p>


    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            [
                'attribute' => 'parent_id',
                'value'=>function ($model) {
                    return $model->parent ? $model->parent->title : '-';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_id',
                    ArrayHelper::map(ArticleCategory::get(0, ArticleCategory::find()->where(['status'=>ArticleCategory::STATUS_ENABLED])->asArray()->all()), 'id', 'label'),
                    ['class' => 'form-control', 'prompt' => Yii::t('common', 'Please Filter')]
                ),
            ],
            'slug',
            'title',
            [
                'attribute' => 'status',
                'value'=>function($model){
                    return ArticleCategory::getStatusText($model->status);
                },
                'filter' => ArticleCategory::getStatusArr(),
            ],

            [
                'label'=>Yii::t('common','Operation'),
                'format'=>'raw',
                'value' => function($data){
                    $viewUrl = Url::to(['view?id='.$data->id]);
                    $updateUrl = Url::to(['update?id='.$data->id]);
                    $deleteUrl = Url::to(['delete?id='.$data->id]);
                    return "<div class='btn-group'>".
                    Html::a(Yii::t('common','View'), $viewUrl, ['title' => Yii::t('common','View'),'class'=>'btn btn-sm btn-info']).
                    Html::a(Yii::t('common','Update'), $updateUrl, ['title' => Yii::t('common','Update'),'class'=>'btn btn-sm btn-primary']).
                    Html::a(Yii::t('common','Delete'), $deleteUrl, ['title' => Yii::t('common','Delete'),'class'=>'btn btn-sm btn-danger','data-method'=>'post', 'data-confirm'=>Yii::t('common','Are you sure you want to delete this item?')]).
                    "</div>";
                },
                'options' => ['style' => 'width:175px;'],
            ],
        ],
    ]); ?>

</div>

<?php
$urlBatchDelete = \yii\helpers\Url::to(['batch-delete']);
$message = Yii::t('common','Are you sure to batch delete?');
$confirmBtn = Yii::t('common','Ok');
$cancleBtn = Yii::t('common','Cancle');
$js = <<<JS
jQuery(document).ready(function() {
    $("#search").click(function(){
        $("#advanced-search-form").toggle();
    });

    $("#batchDelete").click(function() {
        bootbox.confirm(
            {
                message: "{$message}",
                buttons: {
                    confirm: {
                        label: "{$confirmBtn}"
                    },
                    cancel: {
                        label: "{$cancleBtn}"
                    }
                },
                callback: function (confirmed) {
                    if (confirmed) {
                        var keys = $(".grid-view").yiiGridView("getSelectedRows");
                        $.ajax({
                            type: "POST",
                            url: "{$urlBatchDelete}",
                            dataType: "json",
                            data: {ids: keys}
                        });
                    }
                }
            }
        );
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
