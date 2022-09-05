<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_appendicies}}`.
 */
class m220823_171740_create_documents_appendicies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_appendicies', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'appendicies_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_appendicies',
            'documents_appendicies',
            'appendicies_id',
            'appendicies',
            'id'
        );
        $this->addForeignKey(
            'documents_appendicies_documents',
            'documents_appendicies',
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
        $this->dropTable('{{%documents_appendicies}}');
    }
}
