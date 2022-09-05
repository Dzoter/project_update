<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%methodology}}`.
 */
class m220823_171021_create_methodology_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('methodology', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64)
        ]);
        $this->insert('methodology',['name'=>'Investment']);
        $this->insert('methodology',['name'=>'Comparable']);
        $this->insert('methodology',['name'=>'Development']);
        $this->insert('methodology',['name'=>'Development with Social Housing']);
        $this->insert('methodology',['name'=>'Social Housing']);
        $this->insert('methodology',['name'=>'Trading (Hotel)']);
        $this->insert('methodology',['name'=>'Trading (Dental)']);
        $this->insert('methodology',['name'=>'Trading (Nursery/Care Home)']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%methodology}}');
    }
}
