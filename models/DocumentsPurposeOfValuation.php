<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_purpose_of_valuation".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $purpose_of_valuation_id
 *
 * @property Documents $documents
 * @property PurposeOfValuation $purposeOfValuation
 */
class DocumentsPurposeOfValuation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_purpose_of_valuation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'purpose_of_valuation_id'], 'required'],
            [['documents_id', 'purpose_of_valuation_id'], 'integer'],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['documents_id' => 'id']],
            [['purpose_of_valuation_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurposeOfValuation::className(), 'targetAttribute' => ['purpose_of_valuation_id' => 'id']],
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
            'purpose_of_valuation_id' => 'Purpose Of Valuation ID',
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
     * Gets query for [[PurposeOfValuation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurposeOfValuation()
    {
        return $this->hasOne(PurposeOfValuation::className(), ['id' => 'purpose_of_valuation_id']);
    }
}
