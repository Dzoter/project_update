<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tenure}}`.
 */
class m220823_171525_create_tenure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tenure', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64)
        ]);
        $this->insert('tenure',['name'=>'Freehold']);
        $this->insert('tenure',['name'=>'Long Leasehold']);
        $this->insert('tenure',['name'=>'Leasehold']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tenure}}');
    }
}
