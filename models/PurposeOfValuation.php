<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purpose_of_valuation".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsPurposeOfValuation[] $documentsPurposeOfValuations
 */
class PurposeOfValuation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purpose_of_valuation';
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
     * Gets query for [[DocumentsPurposeOfValuations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsPurposeOfValuations()
    {
        return $this->hasMany(DocumentsPurposeOfValuation::className(), ['purpose_of_valuation_id' => 'id']);
    }
}
