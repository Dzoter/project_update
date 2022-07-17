<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_basis_of_value".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $basis_of_value_id
 *
 * @property BasisOfValue $basisOfValue
 * @property Documents $documents
 */
class DocumentsBasisOfValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_basis_of_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'basis_of_value_id'], 'required'],
            [['documents_id', 'basis_of_value_id'], 'integer'],
            [['basis_of_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => BasisOfValue::className(), 'targetAttribute' => ['basis_of_value_id' => 'id']],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['documents_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documents_id' => 'Documents ID',
            'basis_of_value_id' => 'Basis Of Value ID',
        ];
    }

    /**
     * Gets query for [[BasisOfValue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBasisOfValue()
    {
        return $this->hasOne(BasisOfValue::className(), ['id' => 'basis_of_value_id']);
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasOne(Documents::className(), ['id' => 'documents_id']);
    }
}
