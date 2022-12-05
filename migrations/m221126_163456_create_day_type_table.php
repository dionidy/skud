<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%day_type}}`.
 */
class m221126_163456_create_day_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%day_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%day_type}}');
    }
}
