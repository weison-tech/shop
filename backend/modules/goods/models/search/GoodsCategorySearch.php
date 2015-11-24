<?php

namespace backend\modules\goods\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsCategory;
use common\models\User;

/**
 * GoodsCategorySearch represents the model behind the search form about `common\models\GoodsCategory`.
 */
class GoodsCategorySearch extends GoodsCategory
{
    /**
     * 存放搜索时的用户名
     * @var $create_person 创建人
     */
    public $create_person;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'sort', 'create_at', 'create_by', 'update_at', 'update_by', 'status'], 'integer'],
            [['name', 'ico', 'remark', 'create_person'], 'safe'],
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
        $query = GoodsCategory::find()->where(['<>','status',GoodsCategory::STATUS_DELETED])
                ->joinWith(['creator']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'parent_id',
                'name',
                'ico',
                'sort',
                'create_at',
                'create_by',
                'update_at',
                'status',
                'create_person' => [
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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'create_at' => $this->create_at,
            'create_by' => $this->create_by,
            'update_at' => $this->update_at,
            'update_by' => $this->update_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ico', $this->ico])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        $query->andFilterWhere(['like', User::tableName().'.username', $this->create_person]);

        return $dataProvider;
    }
}
