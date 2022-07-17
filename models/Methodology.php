<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "methodology".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsMethodology[] $documentsMethodologies
 */
class Methodology extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'methodology';
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
     * Gets query for [[DocumentsMethodologies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsMethodologies()
    {
        return $this->hasMany(DocumentsMethodology::className(), ['methodology_id' => 'id']);
    }
}
