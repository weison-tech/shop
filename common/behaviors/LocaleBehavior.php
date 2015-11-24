<?php
/**
 *@author xiaomalover <xiaomalover@gmail.com>
 */
namespace common\behaviors;
use yii\base\Behavior;
use Yii;
use yii\web\Application;
/**
 * Class LocaleBehavior
 * @package common\behaviors
 */
class LocaleBehavior extends Behavior
{
    /**
     * @var string
     */
    public $cookieName = '_locale';
    /**
     * @return array
     */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest'
        ];
    }
    /**
     * Resolve application language by checking user cookies, preferred language and profile settings
     */
    public function beforeRequest()
    {
        //ignore console request.
        if(!Yii::$app->request->isConsoleRequest){
            $userLocale = Yii::$app->language;
            $cookieLocale = Yii::$app->getRequest()->getCookies()->getValue($this->cookieName);
            $userLocale = $cookieLocale ? $cookieLocale : $userLocale;
            Yii::$app->language = $userLocale;
        }
    }
}