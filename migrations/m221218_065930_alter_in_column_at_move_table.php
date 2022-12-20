<?php

use yii\db\Migration;

/**
 * Class m221218_065930_alter_in_column_at_move_table
 */
class m221218_065930_alter_in_column_at_move_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('move', 'in', 'date_in');
        $this->renameColumn('move', 'out', 'date_out');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221218_065930_alter_in_column_at_move_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221218_065930_alter_in_column_at_move_table cannot be reverted.\n";

        return false;
    }
    */
}
