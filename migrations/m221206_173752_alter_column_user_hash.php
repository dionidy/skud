<?php

use yii\db\Migration;

/**
 * Class m221206_173752_alter_column_user_hash
 */
class m221206_173752_alter_column_user_hash extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'password_hash', 'string(100) NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221206_173752_alter_column_user_hash cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221206_173752_alter_column_user_hash cannot be reverted.\n";

        return false;
    }
    */
}
