<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_102925_add_users extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'username' => 'admin@test-project.com',
            'auth_key' => '12345678',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345678'),
            'password_reset_token' => md5('12345678'),
        ]);
    }

    public function down()
    {
        echo "m151217_102925_add_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
