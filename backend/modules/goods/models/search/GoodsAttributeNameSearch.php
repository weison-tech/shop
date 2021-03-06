<?php

namespace backend\modules\goods\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsAttributeName;
use common\models\GoodsCategory;
use common\models\User;

/**
 * GoodsAttributeNameSearch represents the model behind the search form about `common\models\GoodsAttributeName`.
 */
class GoodsAttributeNameSearch extends GoodsAttributeName
{
    /**
     * 存放搜索时的分类名
     * @var $category_search 商品分类
     */
    public $category_search;

    /**
     * 存放搜索时的用户名
     * @var $created_person 创建人
     */
    public $created_person;

    /**
     * 存放搜索时的用户名
     * @var $updated_person 修改人
     */
    public $updated_person;

    /**
     * 搜索创建时间 --开始
     */
    public $create_from_date;

    /**
     * 搜索创建时间 --结束
     */
    public $create_to_date;

    /**
     * 搜索修改时间 --开始
     */
    public $updated_from_date;

    /**
     * 搜索修改时间 --结束
     */
    public $updated_to_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'is_sku_attribute', 'sort', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'remark', 'category_search', 'created_person', 'updated_person'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GoodsAttributeName::find()->where(['<>',GoodsAttributeName::tableName().'.status',GoodsAttributeName::STATUS_DELETED])
                ->joinWith(['category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'status',
                'is_sku_attribute',
                'created_at',
                'updated_at',
                'category_search' => [
                    'asc' => [GoodsCategory::tableName().'.name' => SORT_ASC],
                    'desc' => [GoodsCategory::tableName().'.name' => SORT_DESC],
                ],
                'created_person' => [
                    'asc' => [User::tableName().'.username' => SORT_ASC],
                    'desc' => [User::tableName().'.username' => SORT_DESC],
                ],
                'updated_person' => [
                    'asc' => [User::tableName().'.username' => SORT_ASC],
                    'desc' => [User::tableName().'.username' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            'category_id' => $this->category_id,
            'is_sku_attribute' => $this->is_sku_attribute,
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        //created time search
        if(isset($params['create_from_date']) && isset($params['create_to_date']) && $params['create_from_date'] && $params['create_to_date']){
            $this->create_from_date = $params['create_from_date'];
            $this->create_to_date = $params['create_to_date'];
            $query->andFilterWhere(['between', GoodsCategory::tableName().'.created_at', strtotime($this->create_from_date), strtotime($this->create_to_date)]);
        }

        //updated time search
        if(isset($params['updated_from_date']) && isset($params['updated_to_date']) && $params['updated_from_date'] && $params['updated_to_date']){
            $this->updated_from_date = $params['updated_from_date'];
            $this->updated_to_date = $params['updated_to_date'];
            $query->andFilterWhere(['between', GoodsCategory::tableName().'.updated_at', strtotime($this->updated_from_date), strtotime($this->updated_to_date)]);
        }

        $query->andFilterWhere(['like', self::tableName().'.name', $this->name])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        $query->andFilterWhere(['like', GoodsCategory::tableName().'.name', $this->category_search]);
        $query->andFilterWhere(['like', User::tableName().'.username', $this->created_person]);
        $query->andFilterWhere(['like', User::tableName().'.username', $this->updated_person]);

        return $dataProvider;
    }
}
