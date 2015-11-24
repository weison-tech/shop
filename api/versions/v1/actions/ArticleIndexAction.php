<?php
namespace api\versions\v1\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Action;
/**
 * @author xiaoma <xiaomalover@gmail.com>
 * @since 2.0
 */

class ArticleIndexAction extends Action
{

    /**
     * @var callable a PHP callable that will be called to prepare a data provider that
     * should return a collection of the models. If not set, [[prepareDataProvider()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($action) {
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return an instance of [[ActiveDataProvider]].
     */
    public $prepareDataProvider;


    /**
     * @return ActiveDataProvider
     */
    public function run()
    {    	if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        return $this->prepareDataProvider();
    }


    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        /* @var $model Post */
        $model = new $this->modelClass;
        $query = $model::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $model->setAttribute('title', @$_GET['title']);
        $query->andFilterWhere(['like', 'title', $model->title]);

        return $dataProvider;
	}



}