<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use common\models\GoodsCategory;

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

    public $logo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{ms_goods_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'logo', 'sort'], 'required'],
            [['category_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['logo_path','logo_base_url'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 255],
            [['logo'], 'safe'],
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

            ],

            [
                'class' => UploadBehavior::className(),
                'attribute' => 'logo',
                'pathAttribute' => 'logo_path',
                'baseUrlAttribute' => 'logo_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model-goods-brand', 'ID'),
            'category_id' => Yii::t('model-goods-brand', 'Category ID'),
            'name' => Yii::t('model-goods-brand', 'Name'),
            'logo' => Yii::t('model-goods-brand', 'Logo'),
            'logo_path' => Yii::t('model-goods-brand', 'Logo'),
            'logo_base_url' => Yii::t('model-goods-brand', 'Logo Base Url'),
            'sort' => Yii::t('model-goods-brand', 'Sort'),
            'description' => Yii::t('model-goods-brand', 'Description'),
            'status' => Yii::t('model-goods-brand', 'Status'),
            'created_at' => Yii::t('model-goods-brand', 'Created At'),
            'created_by' => Yii::t('model-goods-brand', 'Created By'),
            'updated_at' => Yii::t('model-goods-brand', 'Updated At'),
            'updated_by' => Yii::t('model-goods-brand', 'Updated By'),
            'category_search' => Yii::t('model-goods-brand', 'Category Search'),
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
