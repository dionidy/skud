<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%total_time}}`.
 */
class m221220_052052_create_total_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%total_time}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(),
            'date' => $this->date(),
            'work_time' => $this->integer(),
            'absence_time'=> $this->integer(),
            'absence_type' => $this->integer(), 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%total_time}}');
    }
}
