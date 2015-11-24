<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_goods_category".
 *
 * @property string $id
 * @property integer $parent_id
 * @property string $name
 * @property string $ico
 * @property integer $sort
 * @property string $remark
 * @property integer $create_at
 * @property integer $create_by
 * @property integer $update_at
 * @property integer $update_by
 * @property integer $status
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort', 'create_at', 'create_by', 'update_at', 'update_by', 'status'], 'integer'],
            [['name', 'create_at', 'create_by'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['ico', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model-goods-category', 'ID'),
            'parent_id' => Yii::t('model-goods-category', 'Parent ID'),
            'name' => Yii::t('model-goods-category', 'Name'),
            'ico' => Yii::t('model-goods-category', 'Ico'),
            'sort' => Yii::t('model-goods-category', 'Sort'),
            'remark' => Yii::t('model-goods-category', 'Remark'),
            'create_at' => Yii::t('model-goods-category', 'Create At'),
            'create_by' => Yii::t('model-goods-category', 'Create By'),
            'update_at' => Yii::t('model-goods-category', 'Update At'),
            'update_by' => Yii::t('model-goods-category', 'Update By'),
            'status' => Yii::t('model-goods-category', 'Status'),
        ];
    }
}
