<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basis_of_value".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsBasisOfValue[] $documentsBasisOfValues
 */
class BasisOfValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basis_of_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[DocumentsBasisOfValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsBasisOfValues()
    {
        return $this->hasMany(DocumentsBasisOfValue::className(), ['basis_of_value_id' => 'id']);
    }
}
