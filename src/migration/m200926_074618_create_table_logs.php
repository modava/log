<?php

use yii\db\Migration;

/**
 * Class m200926_074618_create_table_logs
 */
class m200926_074618_create_table_logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $check_table = Yii::$app->db->getTableSchema('logs');
        if ($check_table === null) {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('logs', [
                'id' => $this->bigPrimaryKey(),
                'table_name' => $this->string(255)->notNull(),
                'action' => $this->integer(11)->notNull()->comment('0: -, 1: Create, 2: Update, 3: Delete'),
                'data' => $this->json()->notNull(),
                'created_at' => $this->integer(11)->null(),
                'created_by' => $this->integer(11)->null()
            ], $tableOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200926_074618_create_table_logs cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200926_074618_create_table_logs cannot be reverted.\n";

        return false;
    }
    */
}
