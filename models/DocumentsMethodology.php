<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_methodology".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $methodology_id
 *
 * @property Documents $documents
 * @property Methodology $methodology
 */
class DocumentsMethodology extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_methodology';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'methodology_id'], 'required'],
            [['documents_id', 'methodology_id'], 'integer'],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['documents_id' => 'id']],
            [['methodology_id'], 'exist', 'skipOnError' => true, 'targetClass' => Methodology::className(), 'targetAttribute' => ['methodology_id' => 'id']],
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
            'methodology_id' => 'Methodology ID',
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
     * Gets query for [[Methodology]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMethodology()
    {
        return $this->hasOne(Methodology::className(), ['id' => 'methodology_id']);
    }
}
