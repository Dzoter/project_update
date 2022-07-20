<?php

use yii\db\Migration;

/**
 * Class m220717_072239_new_table
 */
class m220717_072239_new_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('docx', [
            'id'             => $this->primaryKey(),
            'path' => $this->string('255')->notNull(),

        ]);

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
        echo "m220717_072239_new_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220717_072239_new_table cannot be reverted.\n";

        return false;
    }
    */
}
