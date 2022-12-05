<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_right}}`.
 */
class m221205_151326_create_user_right_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_right}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),            
            'type' => $this->smallInteger()->notNull()->comment('Тип'),
            'dep_id' =>$this->integer()->notNull()->comment('Отдел')
        ]);
        
        $this->addForeignKey('fk_user_right_user_id', 'user_right', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_user_right_user_id', 'user_right', 'user_id');        
        
        $this->addForeignKey('fk_user_right_dep_id', 'user_right', 'dep_id', 'dep', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_user_right_dep_id', 'user_right', 'dep_id');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_right}}');
    }
}
