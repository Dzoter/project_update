<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_methodology}}`.
 */
class m220823_172611_create_documents_methodology_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_methodology', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'methodology_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_methodology',
            'documents_methodology',
            'methodology_id',
            'methodology',
            'id'
        );
        $this->addForeignKey(
            'documents_methodology_documents',
            'documents_methodology',
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
        $this->dropTable('{{%documents_methodology}}');
    }
}
