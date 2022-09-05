<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_pdf".
 *
 * @property int $id
 * @property int|null $documents_id
 * @property int|null $pdf_id
 *
 * @property Documents $documents
 * @property Pdf $pdf
 */
class DocumentsPdf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_pdf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'pdf_id'], 'integer'],
            [['pdf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pdf::className(), 'targetAttribute' => ['pdf_id' => 'id']],
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
            'pdf_id' => 'Pdf ID',
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
     * Gets query for [[Pdf]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPdf()
    {
        return $this->hasOne(Pdf::className(), ['id' => 'pdf_id']);
    }
}
