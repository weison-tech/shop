<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\goods\models\search\GoodsBrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('goods-brand', 'Goods Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-brand-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('goods-brand', 'Create Goods Brand'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'name',
            'logo',
            'sort',
            // 'description',
            // 'status',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
