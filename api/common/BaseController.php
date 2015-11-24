<?php
namespace api\common;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii;

class BaseController extends ActiveController
{

    public $serializer = [
        'class' => 'api\common\Serializer',
        'collectionEnvelope' => 'data',
    ];

    public function init()
    {
        parent::init();
        \Yii::$container->set('yii\data\Pagination',[
             'defaultPageSize'=>isset($_GET['limit']) ? $_GET['limit'] : 2
        ]);

    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                // 'application/xml' => Response::FORMAT_XML,
            ],
        ];
        return $behaviors;
    }


    protected function serializeData($data)
    {
        $data = Yii::createObject($this->serializer)->serialize($data);
        $total_page = $data['page']['pageCount'];
        $total_count = $data['page']['totalCount'];
        if($total_count){
        	if(isset($_GET['page']) && $_GET['page']>$total_page){
	            $str = "没有更多数据";
	            $data['data'] = [];
	        }else{
	        	$str = "请求数据成功";
	        }	
        }else{
        	$str = "没有数据";
        	$data['data'] = [];
        }
        
        unset($data['links']);
        unset($data['page']);        
        return ['code'=>200,'msg'=>$str,'data'=>$data['data']];
    }
}
