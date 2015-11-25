<?php

use console\migrations\Migration;

class m151125_105654_create_goods_sku extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_sku}}', [
            'id' => 'MEDIUMINT(1) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "商品明细id"',
            0 => 'PRIMARY KEY (`id`)',
            'goods_id' => 'MEDIUMINT(4) NOT NULL COMMENT "商品id"',
            'sn' => 'CHAR(40) NOT NULL DEFAULT "" COMMENT "明细编号"',
            'value' => 'VARCHAR(255) NOT NULL DEFAULT "" COMMENT "属性及属性值"',
            'market_price' => 'DECIMAL(9,2) NOT NULL COMMENT "市场价"',
            'price' => 'DECIMAL(9,2) NOT NULL COMMENT "销售价"',
            'is_default' => 'TINYINT(1) NOT NULL COMMENT "是否作为默认产品"',
            'is_shelves' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "是否上架"',
            'sort' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "排序"',
            'status' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "状态 0 不启用 1启用 2删除"',
            'created_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "修改时间"',
            'updated_by' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_sku}}');
    }
}
