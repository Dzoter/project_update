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
        $this->createTable('files', [
            'id'             => $this->primaryKey(),
            'name'   => $this->string('255')->notNull(),
            'path' => $this->string('255')->notNull(),

        ]);

        $this->createTable('documents_files', [
            'id'             => $this->primaryKey(),
            'documents_id'   => $this->integer()->notNull(),
            'files_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_files_files',
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
