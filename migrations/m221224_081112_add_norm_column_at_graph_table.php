<?php

use yii\db\Migration;

/**
 * Class m221224_081112_add_norm_column_at_graph_table
 */
class m221224_081112_add_norm_column_at_graph_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('graph', 'norm', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221224_081112_add_norm_column_at_graph_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221224_081112_add_norm_column_at_graph_table cannot be reverted.\n";

        return false;
    }
    */
}
