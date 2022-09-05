<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%documens}}`.
 */
class m220823_164328_create_documens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents', [
            'id' => $this->primaryKey(),
            'property_number'=>$this->char(255),
            'street'=>$this->char(255),
            'town'=>$this->char(255),
            'post_code'=>$this->char(255),
            'post_code_first_part'=>$this->char(255),
            'client'=>$this->char(255),
            'borrower'=>$this->char(255),
            'limited_liability'=>$this->tinyInteger(),
            'same_as_inspection'=>$this->tinyInteger(),
            'valuation_date'=>$this->dateTime(),
            'inspection_date'=>$this->dateTime(),
            'report_date'=>$this->dateTime(),
            'cj_ref'=>$this->char(255),
            'client_ref'=>$this->char(255),
            'valuer'=>$this->char(255),
            'valuer_2'=>$this->char(255),
            'double_signed'=>$this->tinyInteger(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%documens}}');
    }
}
