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
 * @property string $purpose_of_valuation
 * @property string $borrower
 * @property string $limited_liability
 * @property string $same_as_inspection
 * @property string $valuation_date
 * @property string $inspection_date
 * @property string $report_date
 * @property string $cj_ref
 * @property string $clinet_ref
 * @property string $valuer
 * @property string $valuer_2
 * @property string $double_signed
 * @property string $tenure
 * @property string $basis_of_value
 * @property string $sector_overview
 * @property string $methodology
 * @property string $appendicies
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
            [['property_number', 'street', 'town', 'post_code', 'post_code_first_part', 'client', 'purpose_of_valuation', 'borrower', 'limited_liability', 'same_as_inspection', 'valuation_date', 'inspection_date', 'report_date', 'cj_ref', 'clinet_ref', 'valuer', 'valuer_2', 'double_signed', 'tenure', 'basis_of_value', 'sector_overview', 'methodology', 'appendicies'], 'required'],
            [['valuation_date', 'inspection_date', 'report_date'], 'safe'],
            [['property_number', 'street', 'town', 'post_code', 'post_code_first_part', 'client', 'purpose_of_valuation', 'borrower', 'limited_liability', 'same_as_inspection', 'cj_ref', 'clinet_ref', 'valuer', 'valuer_2', 'double_signed', 'tenure', 'basis_of_value', 'sector_overview', 'methodology', 'appendicies'], 'string', 'max' => 255],
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
            'purpose_of_valuation' => 'Purpose Of Valuation',
            'borrower' => 'Borrower',
            'limited_liability' => 'Limited Liability',
            'same_as_inspection' => 'Same As Inspection',
            'valuation_date' => 'Valuation Date',
            'inspection_date' => 'Inspection Date',
            'report_date' => 'Report Date',
            'cj_ref' => 'Cj Ref',
            'clinet_ref' => 'Clinet Ref',
            'valuer' => 'Valuer',
            'valuer_2' => 'Valuer  2',
            'double_signed' => 'Double Signed',
            'tenure' => 'Tenure',
            'basis_of_value' => 'Basis Of Value',
            'sector_overview' => 'Sector Overview',
            'methodology' => 'Methodology',
            'appendicies' => 'Appendicies',
        ];
    }
}
