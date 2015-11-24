<?php
namespace wechat\controllers;

use yii\web\Controller;
use yii\log\FileTarget;
use yii\log\Logger;
use yii;

/**
 * Site controller
 */
class SiteController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionIndex()
	{
		//认证(此方法主要用在公众号后台配置URL时验证使用)
		if(isset($_GET["echostr"])){
			$this->valid();
		}

        //消息接收(微信公众号收到用户信息后，会post $GLOBALS["HTTP_RAW_POST_DATA"]这个参数，把信息放在里面)
		if(isset($GLOBALS["HTTP_RAW_POST_DATA"])){
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			//$this->logResult($postStr, Logger::LEVEL_INFO); //保存用户发送的信息体到log到runtime文件夹下一，wechat.log文件里，方便调试
			if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

	        }else {
	        	echo "";
	        	exit;
	        }
		}
	}

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        return Yii::$app->wechat->checkSignature($signature, $timestamp, $nonce);
	}

	/**
     * 记录微信支付的日志
     */
    private function logResult($word, $level)
    {
        $time = microtime(true);
        $log = new FileTarget();
        $log->logFile = Yii::$app->getRuntimePath() . '/logs/wechat.log';
        $log->messages[] = [$word,$level,'wxpay',$time];
        $log->export();
    }

}
