<?php

use yii\db\Migration;

/**
 * Class m221208_172051_add_password_column_at_user_table
 */
class m221208_172051_add_password_column_at_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'password', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'password');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221208_172051_add_password_column_at_user_table cannot be reverted.\n";

        return false;
    }
    */
}
