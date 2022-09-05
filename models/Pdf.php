<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pdf".
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $name
 *
 * @property DocumentsPdf[] $documentsPdfs
 */
class Pdf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pdf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[DocumentsPdfs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsPdfs()
    {
        return $this->hasMany(DocumentsPdf::className(), ['pdf_id' => 'id']);
    }
    public function getId(){
        return $this->id;
    }
}
