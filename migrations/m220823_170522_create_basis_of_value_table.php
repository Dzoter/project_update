<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basis_of_value}}`.
 */
class m220823_170522_create_basis_of_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('basis_of_value', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64)
        ]);
        $this->insert('basis_of_value',['name'=>'Market Value']);
        $this->insert('basis_of_value',['name'=>'Market Value (special assumption vacant posession)']);
        $this->insert('basis_of_value',['name'=>'Market Value (special assumption 90 days)']);
        $this->insert('basis_of_value',['name'=>'Market Value (special assumption 180 days)']);
        $this->insert('basis_of_value',['name'=>'Market Value (1)']);
        $this->insert('basis_of_value',['name'=>'Market Value (2)']);
        $this->insert('basis_of_value',['name'=>'Market Value (3)']);
        $this->insert('basis_of_value',['name'=>'Gross Development Value']);
        $this->insert('basis_of_value',['name'=>'EUV-SH']);
        $this->insert('basis_of_value',['name'=>'Aggregate Market Value (MV-VP)']);
        $this->insert('basis_of_value',['name'=>'Market Rent']);
        $this->insert('basis_of_value',['name'=>'Reinstatememnt Value']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%basis_of_value}}');
    }
}
