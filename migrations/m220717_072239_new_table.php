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
        $this->createTable('documents_appendicies', [
            'id'             => $this->primaryKey(),
            'documents_id'   => $this->integer()->notNull(),
            'appendicies_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_appendicies_appendicies',
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

        $this->createTable('documents_basis_of_value', [
            'id'                => $this->primaryKey(),
            'documents_id'      => $this->integer()->notNull(),
            'basis_of_value_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_basis_of_value_basis_of_value',
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


        $this->createTable('documents_methodology', [
            'id'             => $this->primaryKey(),
            'documents_id'   => $this->integer()->notNull(),
            'methodology_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_methodology_methodology',
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

        $this->createTable('documents_purpose_of_valuation', [
            'id'                      => $this->primaryKey(),
            'documents_id'            => $this->integer()->notNull(),
            'purpose_of_valuation_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_purpose_of_valuation_purpose_of_valuation',
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


        $this->createTable('documents_sector_overview', [
            'id'                 => $this->primaryKey(),
            'documents_id'       => $this->integer()->notNull(),
            'sector_overview_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_sector_overview_sector_overview',
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


        $this->createTable('documents_tenure', [
            'id'                 => $this->primaryKey(),
            'documents_id'       => $this->integer()->notNull(),
            'tenure_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey(
            'documents_tenure_tenure',
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
