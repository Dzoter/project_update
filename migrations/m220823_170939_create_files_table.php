<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m220823_170939_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'path'=>$this->char(255),
            'name'=>$this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
