<?php

use console\db\Migration;

class m151024_093957_love_author extends Migration
{
    public $tableName = "{{%love__author}}";

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'name' => $this->string()->notNull(),
            'fullname' => $this->string()->notNull(),
            'slug' => $this->string()->unique(),
            'date' => $this->string()->notNull(),
            'intro' => $this->text(),
            'text' => 'MEDIUMTEXT NOT NULL',
            'image' => $this->string()->notNull(),
            'link' => $this->string()->notNull(),
            'in_aph' => 'tinyint(1) NOT NULL DEFAULT 0',
            'in_story' => 'tinyint(1) NOT NULL DEFAULT 0',
            'in_let' => 'tinyint(1) NOT NULL DEFAULT 0',
            'in_poem' => 'tinyint(1) NOT NULL DEFAULT 0',

            'title' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);

        $this->createIndex('idx_author_status', $this->tableName, 'status');
        $this->createIndex('idx_author_aph', $this->tableName, 'in_aph');
        $this->createIndex('idx_author_story', $this->tableName, 'in_story');
        $this->createIndex('idx_author_let', $this->tableName, 'in_let');
        $this->createIndex('idx_author_poem', $this->tableName, 'in_poem');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
