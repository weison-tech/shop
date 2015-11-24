<?php

use console\migrations\Migration;

class m151123_161346_create_goods_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_category}}', [
        'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "分类id"',
        0 => 'PRIMARY KEY (`id`)',
            'parent_id' => 'INT(11) NULL DEFAULT "0" COMMENT "上级分类id"',
            'name' => 'VARCHAR(50) NOT NULL COMMENT "名称"',
            'ico' => 'VARCHAR(255) NULL DEFAULT "" COMMENT "图标"',
            'sort' => 'INT(11) NOT NULL DEFAULT "0" COMMENT "排序"',
            'remark' => 'VARCHAR(255) NULL DEFAULT "" COMMENT "备注"',
            'create_at' => 'INT(11) NOT NULL COMMENT "创建时间"',
            'create_by' => 'INT(11) NOT NULL COMMENT "创建人"',
            'update_at' => 'INT(11) NULL DEFAULT "0" COMMENT "修改时间"',
            'update_by' => 'INT(11) NULL DEFAULT "0" COMMENT "修改人"',
            'status' => 'TINYINT(1) NULL DEFAULT "0" COMMENT "状态（0未启用;1启用;-1删除）"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_category}}');
    }
}
