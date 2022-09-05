<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purpose_of_valution}}`.
 */
class m220823_171156_create_purpose_of_valution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('purpose_of_valuation', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64)
        ]);
        $this->insert('purpose_of_valuation',['name'=>'Loan Security']);
        $this->insert('purpose_of_valuation',['name'=>'Internal']);
        $this->insert('purpose_of_valuation',['name'=>'Other']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purpose_of_valution}}');
    }
}
