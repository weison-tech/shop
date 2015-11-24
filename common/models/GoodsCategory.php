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
     * 商品分类状态常量
     */
    const STATUS_ENABLED = 1; //有效
    const STATUS_DELETED = -1; //删除
    const STATUS_DISABLED = 0; //无效

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


    /**
     * 获取修改人
     * @return ActiveRecord 修改人表记录
     */
    public function getUpdator()
    {
        return $this->hasOne(User::className(), ['id' => 'update_by']);
    }

    /**
     * 获取创建人
     * @return ActiveRecord 创建人表记录
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }


    /**
     * 获取状态选择数组
     * @return Array 状态数组
     */
    public static function getStatusArr()
    {
        return [
            self::STATUS_ENABLED => Yii::t('model-goods-category','Enabled'),
            self::STATUS_DISABLED => Yii::t('model-goods-category','Disabled'),
            // self::STATUS_DELETED => Yii::t('model-goods-category','Deleted'),
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
            $text = Yii::t('model-goods-category','Enabled');
        }else if($status == self::STATUS_DISABLED){
            $text = Yii::t('model-goods-category','Disabled');
        }else if($status == self::STATUS_DELETED){
            $text = Yii::t('model-goods-category','Deleted');
        }
        return $text;
    }
}
