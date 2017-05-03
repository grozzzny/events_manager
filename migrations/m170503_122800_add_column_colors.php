<?php

use yii\db\Migration;

class m170503_122800_add_column_colors extends Migration
{
    public function safeUp()
    {
        $this->addColumn('gr_events_manager', 'color1', $this->string()->defaultValue('#ffffff'));
        $this->addColumn('gr_events_manager', 'color2', $this->string()->defaultValue('#ffffff'));
        $this->addColumn('gr_events_manager', 'color3', $this->string()->defaultValue('#f00000'));
    }

    public function safeDown()
    {

        $this->dropColumn('gr_events_manager', 'color1');
        $this->dropColumn('gr_events_manager', 'color2');
        $this->dropColumn('gr_events_manager', 'color3');

        echo "m170503_122800_add_column_colors cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170503_122800_add_column_colors cannot be reverted.\n";

        return false;
    }
    */
}
