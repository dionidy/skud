<?php

use yii\db\Migration;

/**
 * Class m221212_175305_alter_date_end_column_to_absence_table
 */
class m221212_175305_alter_date_end_column_to_absence_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('absence', 'date_end', 'datetime');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221212_175305_alter_date_end_column_to_absence_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221212_175305_alter_date_end_column_to_absence_table cannot be reverted.\n";

        return false;
    }
    */
}
