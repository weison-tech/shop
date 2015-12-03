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
            [['id', 'parent_id', 'sort', 'created_by', 'updated_by', 'status'], 'integer'],
            [['name', 'remark', 'created_person', 'updated_person', 'create_from_date', 'create_to_date'], 'safe'],
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
        $query = GoodsCategory::find()->where(['<>','status',GoodsCategory::STATUS_DELETED]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'parent_id',
                'name',
                'ico_path',
                'sort',
                'created_at',
                'created_by',
                'status',
                'updated_at',
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

        /**
         * Cause creator and updator use the same table
         * So must handle like below
         */
        if($this->created_person){
            $query->joinWith(['creator']);
        }else if($this->updated_person){
            $query->joinWith(['updator']);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            GoodsCategory::tableName().'.id' => $this->id,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            GoodsCategory::tableName().'.created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ico_path', $this->ico_path])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        $query->andFilterWhere(['like', User::tableName().'.username', $this->created_person]);
        $query->andFilterWhere(['like', User::tableName().'.username', $this->updated_person]);

        return $dataProvider;
    }
}
