<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_docx}}`.
 */
class m220823_172308_create_documents_docx_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('documents_docx', [
            'id'             => $this->primaryKey(),
            'documents_id'   => $this->integer()->notNull(),
            'docx_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_docx',
            'documents_docx',
            'docx_id',
            'docx',
            'id'
        );
        $this->addForeignKey(
            'documents_docx_documents',
            'documents_docx',
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
        $this->dropTable('{{%documents_docx}}');
    }
}
