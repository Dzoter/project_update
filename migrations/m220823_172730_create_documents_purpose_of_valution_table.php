<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_purpose_of_valution}}`.
 */
class m220823_172730_create_documents_purpose_of_valution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_purpose_of_valuation', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'purpose_of_valuation_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_purpose_of_valuation',
            'documents_purpose_of_valuation',
            'purpose_of_valuation_id',
            'purpose_of_valuation',
            'id'
        );
        $this->addForeignKey(
            'documents_purpose_of_valuation_documents',
            'documents_purpose_of_valuation',
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
        $this->dropTable('{{%documents_purpose_of_valution}}');
    }
}
