<?php

use yii\db\Migration;

/**
 * Class m221212_153241_rename_user_calendar_table
 */
class m221212_153241_rename_user_calendar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('user_calendar', 'absence');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221212_153241_rename_user_calendar_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221212_153241_rename_user_calendar_table cannot be reverted.\n";

        return false;
    }
    */
}
