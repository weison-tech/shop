<?php

namespace backend\modules\goods\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsAttributeValue;

/**
 * GoodsAttributeValueSearch represents the model behind the search form about `common\models\GoodsAttributeValue`.
 */
class GoodsAttributeValueSearch extends GoodsAttributeValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'attribute_name_id', 'sort', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'ico'], 'safe'],
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
        $query = GoodsAttributeValue::find()->where(['<>',GoodsAttributeValue::tableName().'.status',GoodsAttributeValue::STATUS_DELETED]);

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
            'attribute_name_id' => $this->attribute_name_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if(isset($_GET['id'])){
            $query->andFilterWhere(['=', 'attribute_name_id', $_GET['id']]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ico', $this->ico]);

        return $dataProvider;
    }
}
