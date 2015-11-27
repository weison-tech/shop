<?php

use console\migrations\Migration;

class m151125_145923_create_goods_brand extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_brand}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "品牌id"',
            0 => 'PRIMARY KEY (`id`)',
            'category_id' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "商品分类id"',
            'name' => 'VARCHAR(32) NOT NULL DEFAULT "" COMMENT "品牌名"',
            'logo_path' => 'VARCHAR(128) NOT NULL DEFAULT "" COMMENT "logo路径"',
            'logo_base_url' => 'VARCHAR(128) NOT NULL DEFAULT "" COMMENT "logo图片基础URL"',
            'sort' => 'TINYINT(4) NOT NULL DEFAULT "0" COMMENT "排序"',
            'description' => 'VARCHAR(255) NULL DEFAULT "" COMMENT "描述"',
            'status' => 'TINYINT(4) NOT NULL DEFAULT "0" COMMENT "状态 0不启用 1启用 2删除"',
            'created_at' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改时间"',
            'updated_by' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_brand}}');
    }
}
