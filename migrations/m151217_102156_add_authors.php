<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_102156_add_authors extends Migration
{
    public function up()
    {
        $this->insert('author', [
            'first_name' => 'Михаил',
            'last_name' => 'Булгаков',
        ]);
        $this->insert('author', [
            'first_name' => 'Рэй',
            'last_name' => 'Брэдбери',
        ]);
        $this->insert('author', [
            'first_name' => 'Эрих Мария',
            'last_name' => 'Ремарк',
        ]);
        $this->insert('author', [
            'first_name' => 'Фёдор',
            'last_name' => 'Достоевский',
        ]);

    }

    public function down()
    {
        echo "m151217_102156_add_authors cannot be reverted.\n";

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
