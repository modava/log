<?php

use yii\db\Migration;

/**
 * Class m201210_065546_add_column_table_key_for_log
 */
class m201210_065546_add_column_table_key_for_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $columns = Yii::$app->db->getTableSchema('logs')->columns;
        if (is_array($columns) && !array_key_exists('table_key', $columns)) {
            $this->addColumn('logs', 'table_key', $this->integer(11)->null()->after('table_name'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201210_065546_add_column_table_key_for_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201210_065546_add_column_table_key_for_log cannot be reverted.\n";

        return false;
    }
    */
}
