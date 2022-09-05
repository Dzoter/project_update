<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documents_sector_overview}}`.
 */
class m220823_172919_create_documents_sector_overview_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents_sector_overview', [
            'id' => $this->primaryKey(),
            'documents_id'=>$this->integer(11),
            'sector_overview_id'=>$this->integer(11)
        ]);
        $this->addForeignKey(
            'documents_sector_overview',
            'documents_sector_overview',
            'sector_overview_id',
            'sector_overview',
            'id'
        );
        $this->addForeignKey(
            'documents_sector_overview_documents',
            'documents_sector_overview',
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
        $this->dropTable('{{%documents_sector_overview}}');
    }
}
