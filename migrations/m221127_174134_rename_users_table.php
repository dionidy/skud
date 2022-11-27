<?php

use yii\db\Migration;

/**
 * Class m221127_174134_rename_users_table
 */
class m221127_174134_rename_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('user', 'role');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221127_174134_rename_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221127_174134_rename_users_table cannot be reverted.\n";

        return false;
    }
    */
}
