<?php

use yii\db\Migration;

/**
 * Class m221222_165355_add_index_move_table
 */
class m221222_165355_add_index_move_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createIndex('idx_move_date_in', 'move', 'date_in');
         $this->createIndex('idx_move_date_out', 'move', 'date_out');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221222_165355_add_index_move_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221222_165355_add_index_move_table cannot be reverted.\n";

        return false;
    }
    */
}
