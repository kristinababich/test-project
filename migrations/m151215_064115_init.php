<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_064115_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
        ], $tableOptions);
        
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
        ], $tableOptions);
        
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(161)->notNull(),
            'date_create' => $this->integer()->notNull(),
            'date_update' => $this->integer()->notNull(),
            'date_release' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'preview' => $this->string()->notNull(),
        ], $tableOptions);
        
        $this->addForeignKey("book_user_fk", "{{%book}}", "author_id", "{{%author}}", "id", 'RESTRICT');
    }

    public function down()
    {
        return false;
    }

}
