<?php

use yii\db\mysql\Schema;

class m170327_090929_files extends \grozzzny\events_manager\migrations\Migration
{
    public function up()
    {
        $this->createTable('gr_events_files', [
            'id' => Schema::TYPE_PK,
            'event_id' => Schema::TYPE_INTEGER,
            'file' => Schema::TYPE_STRING
        ], $this->tableOptions);

        $this->addForeignKey('fk_events_files_event_id', '{{%gr_events_files}}', 'event_id', '{{%gr_events_manager}}', 'id', 'SET NULL');

    }

    public function down()
    {
        $this->dropForeignKey('fk_events_files_event_id', '{{%gr_events_files}}');
        $this->dropTable('gr_events_files');

        echo "m170327_090929_files cannot be reverted.\n";

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
