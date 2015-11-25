<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_goods_brand".
 *
 * @property string $id
 * @property integer $category_id
 * @property string $name
 * @property string $logo
 * @property integer $sort
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class GoodsBrand extends \yii\db\ActiveRecord
{
    /**
     * 商品品牌状态常量
     */
    const STATUS_ENABLED = 1; //有效
    const STATUS_DELETED = 2; //删除
    const STATUS_DISABLED = 0; //无效


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_goods_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'updated_at', 'updated_by'], 'required'],
            [['category_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['logo', 'description'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model-goods_brand', 'ID'),
            'category_id' => Yii::t('model-goods_brand', 'Category ID'),
            'name' => Yii::t('model-goods_brand', 'Name'),
            'logo' => Yii::t('model-goods_brand', 'Logo'),
            'sort' => Yii::t('model-goods_brand', 'Sort'),
            'description' => Yii::t('model-goods_brand', 'Description'),
            'status' => Yii::t('model-goods_brand', 'Status'),
            'created_at' => Yii::t('model-goods_brand', 'Created At'),
            'created_by' => Yii::t('model-goods_brand', 'Created By'),
            'updated_at' => Yii::t('model-goods_brand', 'Updated At'),
            'updated_by' => Yii::t('model-goods_brand', 'Updated By'),
        ];
    }
}
