<?php

use console\migrations\Migration;

class m151125_112515_create_goods_sku_attribute_item extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_sku_attribute_item}}', [
            'id' => 'INT(1) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "SKU属性项id"',
            0 => 'PRIMARY KEY (`id`)',
            'goods_id' => 'INT(1) NOT NULL COMMENT "商品id"',
            'attribute_name_id' => 'INT(1) NOT NULL COMMENT "属性名id"',
            'attribute_value_id' => 'INT(1) NOT NULL COMMENT "原属性值id"',
            'name' => 'CHAR(30) NOT NULL COMMENT "自定义的新属性值"',
            'sort' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "排序"',
            'status' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "状态 0 不启用 1 启用 2 删除"',
            'created_at' => 'INT(1) NOT NULL COMMENT "创建时间"',
            'created_by' => 'INT(1) NOT NULL COMMENT "创建人"',
            'updated_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "修改时间"',
            'updated_by' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_sku_attribute_item}}');
    }
}
