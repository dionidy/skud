<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%total_time}}`.
 */
class m221220_074146_create_total_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%total_time}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->comment('Сотрудник'),
            'date' => $this->date()->comment('Дата'),
            'work_time' => $this->integer()->comment('Отработано'),
            'absence_time'=> $this->integer()->comment('Пропущено'),
            'absence_type' => $this->integer()->comment('Тип пропуска'), 
        ]);
        
        $this->addForeignKey('fk_total_time_employee_id', 'total_time', 'employee_id', 'employee', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_total_time_employee_id', 'total_time', 'employee_id');
        
        $this->createIndex('idx_total_time_date', 'total_time', 'date');
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%total_time}}');
    }
}
