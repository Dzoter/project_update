<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_basis_of_value}}`.
 */
class m220823_172112_create_documents_basis_of_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_basis_of_value', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'basis_of_value_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_basis_of_value',
            'documents_basis_of_value',
            'basis_of_value_id',
            'basis_of_value',
            'id'
        );
        $this->addForeignKey(
            'documents_basis_of_value_documents',
            'documents_basis_of_value',
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
        $this->dropTable('{{%documents_basis_of_value}}');
    }
}
