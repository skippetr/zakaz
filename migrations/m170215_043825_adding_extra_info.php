<?php

use yii\db\Schema;
use yii\db\Migration;

class m170215_043825_adding_extra_info extends Migration
{
    public function up()
    {

        $this->createTable('regions', [
            'id' => Schema::TYPE_SMALLINT,
            'region' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('technics', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'subTech' => Schema::TYPE_STRING,
        ]);

        //TODO: change encoding in phpMyAdmin

    }

    public function down()
    {

        $this->dropTable('regions');
        $this->dropTable('technics');

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
