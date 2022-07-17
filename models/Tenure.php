<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tenure".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsTenure[] $documentsTenures
 */
class Tenure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenure';
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
     * Gets query for [[DocumentsTenures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsTenures()
    {
        return $this->hasMany(DocumentsTenure::className(), ['tenure_id' => 'id']);
    }
}
