<?php

use yii\db\Migration;

/**
 * Class m240415_074001_add_access_token_to_user_table
 */
class m240415_074001_add_access_token_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}','access_token',$this->string(512)->after('auth_key'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%user}}', 'access_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240415_074001_add_access_token_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
