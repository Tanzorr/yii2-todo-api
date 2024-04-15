<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m240412_141729_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512),
            'body' => $this->text(),
            'task_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer()
        ]);

        $this->addForeignKey('FC_comment_task_id', '{{%comment}}', 'task_id', '{{%task}}', 'id');
        $this->addForeignKey('FC_comment_user_create_by', '{{%comment}}', 'created_by', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
        $this->dropForeignKey('FC_comment_task_id', '{{%comment}}');
        $this->dropForeignKey('FC_comment_user_create_by', '{{%comment}}');

    }
}
