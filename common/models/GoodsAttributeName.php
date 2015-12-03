<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%goods_attribute_name}}".
 *
 * @property string $id
 * @property string $category_id
 * @property string $name
 * @property integer $is_sku_attribute
 * @property string $remark
 * @property integer $sort
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class GoodsAttributeName extends \yii\db\ActiveRecord
{
    /**
     * 商品属性状态常量
     */
    const STATUS_ENABLED = 1; //有效
    const STATUS_DELETED = 2; //删除
    const STATUS_DISABLED = 0; //无效

    /**
     * 是否SKU属性常量
     */
    const IS_SKU_NO = 0; //是SKU属性
    const IS_SKU_YES = 1; //不是SKU属性

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute_name}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'is_sku_attribute', 'sort'], 'required'],
            [['category_id', 'is_sku_attribute', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['remark'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'=>BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model-goods-attribute', 'ID'),
            'category_id' => Yii::t('model-goods-attribute', 'Category ID'),
            'name' => Yii::t('model-goods-attribute', 'Name'),
            'is_sku_attribute' => Yii::t('model-goods-attribute', 'Is Sku Attribute'),
            'remark' => Yii::t('model-goods-attribute', 'Remark'),
            'sort' => Yii::t('model-goods-attribute', 'Sort'),
            'status' => Yii::t('model-goods-attribute', 'Status'),
            'created_at' => Yii::t('model-goods-attribute', 'Created At'),
            'created_by' => Yii::t('model-goods-attribute', 'Created By'),
            'updated_at' => Yii::t('model-goods-attribute', 'Updated At'),
            'updated_by' => Yii::t('model-goods-attribute', 'Updated By'),
            'category_search' => Yii::t('model-goods-attribute', 'Category Search'),
            'created_person' => Yii::t('model-goods-attribute', 'Create Person'),
            'updated_person' => Yii::t('model-goods-attribute', 'Updated Person'),
        ];
    }

    /**
     * 获取分类
     * @return ActiveRecord 商品分类表记录
     */
    public function getCategory()
    {
        return $this->hasOne(GoodsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * 获取修改人
     * @return ActiveRecord 修改人表记录
     */
    public function getUpdator()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * 获取创建人
     * @return ActiveRecord 创建人表记录
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


    /**
     * 获取状态选择数组
     * @return Array 状态数组
     */
    public static function getStatusArr()
    {
        return [
            self::STATUS_ENABLED => Yii::t('model-goods-attribute','Enabled'),
            self::STATUS_DISABLED => Yii::t('model-goods-attribute','Disabled'),
            // self::STATUS_DELETED => Yii::t('model-goods-attribute','Deleted'),
        ];
    }


    /**
     * 获取是否SKU属性选择数组
     * @return Array 是否SKU数组
     */
    public static function getIsSkuArr()
    {
        return [
            self::IS_SKU_YES => Yii::t('model-goods-attribute','Not Sku'),
            self::IS_SKU_NO => Yii::t('model-goods-attribute','Is Sku'),
        ];
    }

    /**
     * 根据状态码获取状态描述
     * @param  Int $status 状态码
     * @return String $text 状态描述文字
     */
    public static function getStatusText($status)
    {
        $text = '';
        if($status == self::STATUS_ENABLED){
            $text = Yii::t('model-goods-attribute','Enabled');
        }else if($status == self::STATUS_DISABLED){
            $text = Yii::t('model-goods-attribute','Disabled');
        }else if($status == self::STATUS_DELETED){
            $text = Yii::t('model-goods-attribute','Deleted');
        }
        return $text;
    }


    /**
     * 根据是否SKU值获取是否SKU文字
     * @param  Int $isSku 是否SKU值
     * @return String $text 是否SKU文字
     */
    public static function getIsSkuText($isSku)
    {
        $text = '';
        if($isSku == self::IS_SKU_YES){
            $text = Yii::t('model-goods-attribute','Is Sku');
        }else if($isSku == self::IS_SKU_NO){
            $text = Yii::t('model-goods-attribute','Not Sku');
        }
        return $text;
    }
}
