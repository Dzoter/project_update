<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 *
 * @property DocumentsFiles[] $documentsFiles
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['name', 'path'], 'string', 'max' => 255],
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
            'path' => 'Path',
        ];
    }

    /**
     * Gets query for [[DocumentsFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsFiles()
    {
        return $this->hasMany(DocumentsFiles::className(), ['files_id' => 'id']);
    }
    public function getId(){
        return $this->id;
    }
}
