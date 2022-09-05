<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sector_overview}}`.
 */
class m220823_171317_create_sector_overview_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sector_overview', [
            'id' => $this->primaryKey(),
            'name'=>$this->char(64),
            'info'=>$this->text()
        ]);
        $this->insert('sector_overview',['name'=>'Commercial','info'=>'qwe']);
        $this->insert('sector_overview',['name'=>'Residential','info'=>'Residentials']);
        $this->insert('sector_overview',['name'=>'Hotels','info'=>'asds']);
        $this->insert('sector_overview',['name'=>'Dental','info'=>'Dentals']);
        $this->insert('sector_overview',['name'=>'Care Homes','info'=>'Care Homess']);
        $this->insert('sector_overview',['name'=>'Nurseries','info'=>'Nurseriess']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sector_overview}}');
    }
}
