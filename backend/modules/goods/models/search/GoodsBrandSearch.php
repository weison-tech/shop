<?php

namespace backend\modules\goods\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsBrand;

/**
 * GoodsBrandSearch represents the model behind the search form about `common\models\GoodsBrand`.
 */
class GoodsBrandSearch extends GoodsBrand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'logo', 'description'], 'safe'],
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
        $query = GoodsBrand::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'category_id' => $this->category_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
