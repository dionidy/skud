<?php

use yii\db\Migration;

/**
 * Class m221223_053837_add_overtime_column_at_total_time_table
 */
class m221223_053837_add_overtime_column_at_total_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('total_time', 'over_time', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221223_053837_add_overtime_column_at_total_time_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221223_053837_add_overtime_column_at_total_time_table cannot be reverted.\n";

        return false;
    }
    */
}
