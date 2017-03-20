<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m170320_120714_add_column_sort extends Migration
{
    public function up()
    {
        $this->addColumn('gr_events_manager', 'sort', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('gr_events_manager', 'sort');
        echo "m170320_120714_add_column_sort cannot be reverted.\n";

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
