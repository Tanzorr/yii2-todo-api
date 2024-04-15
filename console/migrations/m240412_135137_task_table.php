<?php

use yii\db\Migration;

/**
 * Class m240412_135137_task_table
 */
class m240412_135137_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id'=> $this->primaryKey(),
            'title'=>$this->string(512),
            'body'=>'LONGTEXT',
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer()
        ]);

        $this->addForeignKey('FC_task_user_created_by', '{{%task}}', 'created_by', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FC_task_user_created_by', '{{%task}}');
        $this->dropTable('{{%task}}');
        echo "m240412_135137_task_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240412_135137_task_table cannot be reverted.\n";

        return false;
    }
    */
}
