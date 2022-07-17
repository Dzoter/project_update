<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appendicies".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsAppendicies[] $documentsAppendicies
 */
class Appendicies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appendicies';
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
     * Gets query for [[DocumentsAppendicies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsAppendicies()
    {
        return $this->hasMany(DocumentsAppendicies::className(), ['appendicies_id' => 'id']);
    }
}
