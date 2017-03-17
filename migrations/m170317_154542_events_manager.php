<?php

use grozzzny\events-manager\migrations\Migration;
use yii\db\mysql\Schema;

class m170317_154542_events_manager extends Migration
{
    public function up()
    {
/*
описание события, сортировка"
*/
        $this->createTable('gr_events_manager', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'preview' => Schema::TYPE_STRING,
            'datetime' => Schema::TYPE_INTEGER,
            'soc_vk' => Schema::TYPE_STRING,
            'soc_fb' => Schema::TYPE_STRING,
            'soc_inst' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'slider' => Schema::TYPE_BOOLEAN . " DEFAULT '0'",
            'home_page' => Schema::TYPE_BOOLEAN . " DEFAULT '0'",

            'status' => Schema::TYPE_BOOLEAN . " DEFAULT '1'",
            'order_num' => Schema::TYPE_INTEGER . " NOT NULL",
        ], $this->tableOptions);


        $this->insert('easyii_modules', [
            'name' => 'eventsmanager',
            'class' => 'grozzzny\events_manager\Module',
            'title' => 'Events manager',
            'icon' => 'font',
            'status' => 1,
            'settings' => '[]',
            'notice' => 0,
            'order_num' => 120
        ]);
    }

    public function down()
    {
        $this->dropTable('gr_events_manager');
        $this->delete('easyii_modules',['name' => 'eventsmanager']);

        echo "m170317_154542_events_manager cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
