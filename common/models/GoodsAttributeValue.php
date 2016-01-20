<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use common\models\GoodsAttributeName;

/**
 * This is the model class for table "{{%goods_attribute_value}}".
 *
 * @property string $id
 * @property string $attribute_name_id
 * @property string $name
 * @property string $ico_path
 * @property integer $sort
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class GoodsAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * Goods attribute value status const
     */
    const STATUS_ENABLED = 1; //enabled
    const STATUS_DELETED = 2; //disabled
    const STATUS_DISABLED = 0; //deleted

    /**
     * ico attribute
     */
    public $ico;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute_value}}';
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

            ],

            [
                'class' => UploadBehavior::className(),
                'attribute' => 'ico',
                'pathAttribute' => 'ico_path',
                'baseUrlAttribute' => false,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_name_id', 'name', 'sort'], 'required'],
            [['attribute_name_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['ico_path'], 'string', 'max' => 128],
            [['ico'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model-goods-attribute', 'ID'),
            'attribute_name_id' => Yii::t('model-goods-attribute', 'Attribute Name ID'),
            'name' => Yii::t('model-goods-attribute', 'Attribute Value'),
            'ico' => Yii::t('model-goods-attribute', 'Ico Path'),
            'ico_path' => Yii::t('model-goods-attribute', 'Ico Path'),
            'sort' => Yii::t('model-goods-attribute', 'Sort'),
            'status' => Yii::t('model-goods-attribute', 'Status'),
            'created_at' => Yii::t('model-goods-attribute', 'Created At'),
            'created_by' => Yii::t('model-goods-attribute', 'Created By'),
            'updated_at' => Yii::t('model-goods-attribute', 'Updated At'),
            'updated_by' => Yii::t('model-goods-attribute', 'Updated By'),
        ];
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
     * relation to Attribute name
     * @return ActiveRecord Attribute name recorder
     */
    public function getAttributeName()
    {
        return $this->hasOne(GoodsAttributeName::className(), ['id' => 'updated_by']);
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
