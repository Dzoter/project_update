<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_appendicies".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $appendicies_id
 *
 * @property Appendicies $appendicies
 * @property Documents $documents
 */
class DocumentsAppendicies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_appendicies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'appendicies_id'], 'required'],
            [['documents_id', 'appendicies_id'], 'integer'],
            [['appendicies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appendicies::className(), 'targetAttribute' => ['appendicies_id' => 'id']],
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
            'appendicies_id' => 'Appendicies ID',
        ];
    }

    /**
     * Gets query for [[Appendicies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppendicies()
    {
        return $this->hasOne(Appendicies::className(), ['id' => 'appendicies_id']);
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
}
