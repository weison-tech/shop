<?php

namespace backend\modules\goods\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsBrand;
use common\models\GoodsCategory;

/**
 * GoodsBrandSearch represents the model behind the search form about `common\models\GoodsBrand`.
 */
class GoodsBrandSearch extends GoodsBrand
{
    /**
     * 存放搜索时的分类名
     * @var $category_search 商品分类
     */
    public $category_search;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'logo_path', 'description', 'category_search'], 'safe'],
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
        $query = GoodsBrand::find()->where(['<>',GoodsBrand::tableName().'.status',GoodsBrand::STATUS_DELETED])
                ->joinWith(['category']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'logo',
                'logo_path',
                'logo_base_url',
                'sort',
                'description',
                'status',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'category_search' => [
                    'asc' => [GoodsCategory::tableName().'.name' => SORT_ASC],
                    'desc' => [GoodsCategory::tableName().'.name' => SORT_DESC],
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
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.name', $this->name])
            ->andFilterWhere(['like', 'logo_path', $this->logo_path])
            ->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', GoodsCategory::tableName().'.name', $this->category_search]);

        return $dataProvider;
    }
}
