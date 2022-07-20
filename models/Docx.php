<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docx".
 *
 * @property int $id
 * @property string $path
 *
 * @property DocumentsDocx[] $documentsDocxes
 */
class Docx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'docx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[DocumentsDocxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsDocxes()
    {
        return $this->hasMany(DocumentsDocx::className(), ['docx_id' => 'id']);
    }

    public function getId(){
        return $this->id;
    }
}
