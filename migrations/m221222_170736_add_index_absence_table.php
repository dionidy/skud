<?php

use yii\db\Migration;

/**
 * Class m221222_170736_add_index_absence_table
 */
class m221222_170736_add_index_absence_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx_absence_date_start', 'absence', 'date_start');
        $this->createIndex('idx_absence_date_end', 'absence', 'date_end');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221222_170736_add_index_absence_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221222_170736_add_index_absence_table cannot be reverted.\n";

        return false;
    }
    */
}
