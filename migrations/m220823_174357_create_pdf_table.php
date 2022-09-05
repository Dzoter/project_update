<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pdf}}`.
 */
class m220823_174357_create_pdf_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pdf', [
            'id' => $this->primaryKey(),
            'path'=>$this->char(255),
            'name'=>$this->text()
        ]);
        $this->createTable('documents_pdf', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'pdf_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_pdf',
            'documents_pdf',
            'pdf_id',
            'pdf',
            'id'
        );
        $this->addForeignKey(
            'documents_pdf_documents',
            'documents_pdf',
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
        $this->dropTable('{{%pdf}}');
    }
}
