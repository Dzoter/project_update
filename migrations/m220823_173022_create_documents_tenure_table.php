<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_tenure}}`.
 */
class m220823_173022_create_documents_tenure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_tenure', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'tenure_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_tenure',
            'documents_tenure',
            'tenure_id',
            'tenure',
            'id'
        );
        $this->addForeignKey(
            'documents_tenure_documents',
            'documents_tenure',
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
        $this->dropTable('{{%documents_tenure}}');
    }
}
