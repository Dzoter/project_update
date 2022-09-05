<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%docx}}`.
 */
class m220823_170848_create_docx_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('docx', [
            'id' => $this->primaryKey(),
            'path'=>$this->char(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%docx}}');
    }
}
