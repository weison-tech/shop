<?php
namespace api\models;

use common\models\Article as BaseArticle;

/**
 * xiaoma <xiaomalover@gmail.com>
 */
class Article extends BaseArticle
{
	public function fields()
	{
		return [
			'id',
			'title',
			'body',
			'created_at'=>function(){
				return date('Y-m-d H:i:s',$this->created_at);
			},
		];
	}
}