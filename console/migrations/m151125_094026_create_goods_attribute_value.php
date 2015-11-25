<?php

use console\migrations\Migration;

class m151125_094026_create_goods_attribute_value extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_attribute_value}}', [
            'id' => 'INT(1) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "属性值id"',
            0 => 'PRIMARY KEY (`id`)',
            'attribute_name_id' => 'INT(1) NOT NULL COMMENT "属性名id"',
            'name' => 'VARCHAR(30) NOT NULL COMMENT "属性值"',
            'ico' => 'VARCHAR(256) NULL DEFAULT "" COMMENT "图标"',
            'sort' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "排序"',
            'status' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "状态 0 不启用 1 启用 2 删除"',
            'created_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(1) NOT NULL COMMENT "修改时间"',
            'updated_by' => 'INT(1) NOT NULL COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_attribute_value}}');
    }
}
