<?php

use console\migrations\Migration;

class m151125_094020_create_goods_attribute_name extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_attribute_name}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "属性名id"',
            0 => 'PRIMARY KEY (`id`)',
            'category_id' => 'INT(11) UNSIGNED NOT NULL COMMENT "分类id"',
            'name' => 'VARCHAR(32) NOT NULL DEFAULT "" COMMENT "属性名"',
            'is_sku_attribute' => 'TINYINT(4) NOT NULL DEFAULT "0" COMMENT "是否是sku属性"',
            'remark' => 'VARCHAR(128) NOT NULL DEFAULT "" COMMENT "备注"',
            'sort' => 'TINYINT(4) NOT NULL DEFAULT "0" COMMENT "排序"',
            'status' => 'TINYINT(4) NOT NULL DEFAULT "0" COMMENT "状态 0不启用 1启用 2删除"',
            'created_at' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改时间"',
            'updated_by' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_attribute_name}}');
    }
}
