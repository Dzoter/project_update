<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string $property_number
 * @property string $street
 * @property string $town
 * @property string $post_code
 * @property string $post_code_first_part
 * @property string $client
 * @property string $borrower
 * @property int $limited_liability
 * @property string $same_as_inspection
 * @property string|null $valuation_date
 * @property string|null $inspection_date
 * @property string|null $report_date
 * @property string $cj_ref
 * @property string $client_ref
 * @property string $valuer
 * @property string $valuer_2
 * @property int $double_signed
 *
 * @property DocumentsAppendicies[] $documentsAppendicies
 * @property DocumentsBasisOfValue[] $documentsBasisOfValues
 * @property DocumentsMethodology[] $documentsMethodologies
 * @property DocumentsPurposeOfValuation[] $documentsPurposeOfValuations
 * @property DocumentsSectorOverview[] $documentsSectorOverviews
 * @property DocumentsTenure[] $documentsTenures
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_number', 'street', 'town', 'post_code', 'post_code_first_part', 'client', 'borrower', 'limited_liability', 'same_as_inspection', 'cj_ref', 'client_ref', 'valuer', 'valuer_2', 'double_signed'], 'required'],
            [['limited_liability', 'double_signed'], 'integer'],
            [['valuation_date', 'inspection_date', 'report_date'], 'safe'],
            [['property_number', 'street', 'town', 'post_code', 'post_code_first_part', 'client', 'borrower', 'same_as_inspection', 'cj_ref', 'client_ref', 'valuer', 'valuer_2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_number' => 'Property Number',
            'street' => 'Street',
            'town' => 'Town',
            'post_code' => 'Post Code',
            'post_code_first_part' => 'Post Code First Part',
            'client' => 'Client',
            'borrower' => 'Borrower',
            'limited_liability' => 'Limited Liability',
            'same_as_inspection' => 'Same As Inspection',
            'valuation_date' => 'Valuation Date',
            'inspection_date' => 'Inspection Date',
            'report_date' => 'Report Date',
            'cj_ref' => 'Cj Ref',
            'client_ref' => 'Client Ref',
            'valuer' => 'Valuer',
            'valuer_2' => 'Valuer  2',
            'double_signed' => 'Double Signed',
        ];
    }

    /**
     * Gets query for [[DocumentsAppendicies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsAppendicies()
    {
        return $this->hasMany(DocumentsAppendicies::className(), ['documents_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentsBasisOfValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsBasisOfValues()
    {
        return $this->hasMany(DocumentsBasisOfValue::className(), ['documents_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentsMethodologies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsMethodologies()
    {
        return $this->hasMany(DocumentsMethodology::className(), ['documents_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentsPurposeOfValuations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsPurposeOfValuations()
    {
        return $this->hasMany(DocumentsPurposeOfValuation::className(), ['documents_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentsSectorOverviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsSectorOverviews()
    {
        return $this->hasMany(DocumentsSectorOverview::className(), ['documents_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentsTenures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsTenures()
    {
        return $this->hasMany(DocumentsTenure::className(), ['documents_id' => 'id']);
    }
    public function getId()
    {
        return $this->id;
    }
}
