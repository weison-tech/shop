<?php

use console\migrations\Migration;

class m151123_161346_create_goods_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods_category}}', [
        'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "分类id"',
        0 => 'PRIMARY KEY (`id`)',
            'parent_id' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "父分类id"',
            'name' => 'VARCHAR(64) NOT NULL DEFAULT "" COMMENT "名称"',
            'ico_path' => 'VARCHAR(128) NULL DEFAULT "" COMMENT "图标路径"',
            'ico_base_url' => 'VARCHAR(128) NULL DEFAULT "" COMMENT "图标URL"',
            'sort' => 'INT(11) NOT NULL DEFAULT "0" COMMENT "排序"',
            'remark' => 'VARCHAR(128) NULL DEFAULT "" COMMENT "备注"',
            'status' => 'TINYINT(4) NULL DEFAULT "0" COMMENT "状态 0不启用 1启用 2删除"',
            'created_at' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建时间"',
            'created_by' => 'INT(11) UNSIGNED NOT NULL DEFAULT "0" COMMENT "创建人"',
            'updated_at' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改时间"',
            'updated_by' => 'INT(11) UNSIGNED NULL DEFAULT "0" COMMENT "修改人"',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_category}}');
    }
}
