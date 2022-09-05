<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_files}}`.
 */
class m220823_172431_create_documents_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_files', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'files_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_files',
            'documents_files',
            'files_id',
            'files',
            'id'
        );
        $this->addForeignKey(
            'documents_files_documents',
            'documents_files',
            'documents_id',
            'documents',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%documents_files}}');
    }
}
