<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%Total_Time}}`.
 */
class m221220_073644_drop_Total_Time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%total_time}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%total_time}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
