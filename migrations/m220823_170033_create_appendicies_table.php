<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appendicies}}`.
 */
class m220823_170033_create_appendicies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('appendicies', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64)
        ]);
        $this->insert('appendicies',['name'=>'Letter of Instruction']);
        $this->insert('appendicies',['name'=>'Letter of Acknowledgement']);
        $this->insert('appendicies',['name'=>'Title Plan']);
        $this->insert('appendicies',['name'=>'Leases']);
        $this->insert('appendicies',['name'=>'Particulars']);
        $this->insert('appendicies',['name'=>'Groundsure']);
        $this->insert('appendicies',['name'=>'Development Appraisal']);
        $this->insert('appendicies',['name'=>'Proposed Plans']);
        $this->insert('appendicies',['name'=>'Accounts']);
        $this->insert('appendicies',['name'=>'CQC']);
        $this->insert('appendicies',['name'=>'Other']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appendicies}}');
    }
}
