<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m170323_141340_add_columns_events_manager extends Migration
{
    public function up()
    {

        $this->addColumn('gr_events_manager','audio',Schema::TYPE_STRING);
        $this->addColumn('gr_events_manager','tab', Schema::TYPE_BOOLEAN . " DEFAULT '0'");

    }

    public function down()
    {
        $this->dropColumn('gr_events_manager','audio');
        $this->dropColumn('gr_events_manager','tab');

        echo "m170323_141340_add_columns_events_manager cannot be reverted.\n";

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
