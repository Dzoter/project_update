<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_docx".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $docx_id
 *
 * @property Documents $documents
 * @property Docx $docx
 */
class DocumentsDocx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_docx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'docx_id'], 'required'],
            [['documents_id', 'docx_id'], 'integer'],
            [['docx_id'], 'exist', 'skipOnError' => true, 'targetClass' => Docx::className(), 'targetAttribute' => ['docx_id' => 'id']],
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
            'docx_id' => 'Docx ID',
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
     * Gets query for [[Docx]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocx()
    {
        return $this->hasOne(Docx::className(), ['id' => 'docx_id']);
    }
}
