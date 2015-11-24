<?php
/**
 *@author xiaomalover <xiaomalover@gmail.com>
 */
namespace backend\behaviors;
use yii\base\Behavior;
use Yii;
use yii\base\Controller;
/**
 * Class LocaleBehavior
 * @package common\behaviors
 */
class LayoutBehavior extends Behavior
{
    /**
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }
    /**
     * Resolve application language by checking user cookies, preferred language and profile settings
     */
    public function beforeAction()
    {
    	if($this->owner->controller->id == 'security' && $this->owner->controller->action->id == 'login'){
    		$this->owner->controller->layout = "/main";
    	}else{
    		$this->owner->controller->layout = "/common";
    	}
    }
}