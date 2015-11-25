<?php

use console\migrations\Migration;

class m151125_063206_create_goods extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "商品id"',
            0 => 'PRIMARY KEY (`id`)',
            'category_id' => 'INT(3) NOT NULL COMMENT "分类id"',
            'store_category_id' => 'INT(3) NULL DEFAULT "0" COMMENT "店铺自定义分类id"',
            'store_id' => 'INT(4) NOT NULL COMMENT "店铺id"',
            'brand_id' => 'INT(1) NOT NULL COMMENT "品牌id"',
            'sn' => 'CHAR(40) NOT NULL COMMENT "商品编号"',
            'name' => 'VARCHAR(200) NOT NULL COMMENT "商品名"',
            'locality' => 'VARCHAR(20) NOT NULL DEFAULT "" COMMENT "商品产地"',
            'sort' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "排序"',
            'is_shelves' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "是否上架"',
            'standard' => 'VARCHAR(512) NOT NULL  DEFAULT "" COMMENT "普通规格属性"',
            'description' => 'TEXT NULL COMMENT "描述"',
            'status' => 'TINYINT(1) NOT NULL DEFAULT "0" COMMENT "状态：0待审核  1可售卖  2删除 3禁售卖"',
            'created_at' => 'INT(1) NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'VARCHAR(32) NOT NULL DEFAULT "" COMMENT "创建人"',
            'updated_at' => 'INT(1) NOT NULL COMMENT "修改时间"',
            'updated_by' => 'VARCHAR(32) NOT NULL COMMENT "修改人"',
            'price' => 'DECIMAL(9,2) NOT NULL COMMENT "销售价"',
            'market_price' => 'DECIMAL(9,2) NOT NULL COMMENT "市场价"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods}}');
    }
}
