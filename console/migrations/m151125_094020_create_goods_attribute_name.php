<?php

use console\migrations\Migration;

class m151125_094020_create_goods_attribute_name extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_attribute_name}}', [
            'id' => 'INT(1) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "属性名id"',
            0 => 'PRIMARY KEY (`id`)',
            'category_id' => 'INT(1) NOT NULL COMMENT "分类id"',
            'name' => 'VARCHAR(30) NOT NULL COMMENT "属性名"',
            'type' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "属性类型 1 单选 2多选 3 文本"',
            'is_sku_attribute' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "是否是sku属性"',
            'remark' => 'VARCHAR(200) NOT NULL DEFAULT "" COMMENT "备注"',
            'sort' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "排序"',
            'status' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "状态 0 不启用 1 启用 2 删除"',
            'created_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(1) NOT NULL COMMENT "修改时间"',
            'updated_by' => 'MEDIUMINT(1) NOT NULL COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_attribute_name}}');
    }
}
