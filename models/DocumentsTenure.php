<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_tenure".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $tenure_id
 *
 * @property Documents $documents
 * @property Tenure $tenure
 */
class DocumentsTenure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_tenure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'tenure_id'], 'required'],
            [['documents_id', 'tenure_id'], 'integer'],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['documents_id' => 'id']],
            [['tenure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tenure::className(), 'targetAttribute' => ['tenure_id' => 'id']],
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
            'tenure_id' => 'Tenure ID',
        ];
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

    /**
     * Gets query for [[Tenure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTenure()
    {
        return $this->hasOne(Tenure::className(), ['id' => 'tenure_id']);
    }
}
