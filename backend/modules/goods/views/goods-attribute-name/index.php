<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\goods\models\search\GoodsAttributeNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goods-attribute-name', 'Goods Attribute Names');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-attribute-name-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goods-attribute-name', 'Create Goods Attribute Name'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'name',
            'is_sku_attribute',
            'remark',
            // 'sort',
            // 'status',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
