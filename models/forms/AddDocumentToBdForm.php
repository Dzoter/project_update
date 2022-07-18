<?php

namespace app\models\forms;

use app\models\Appendicies;
use app\models\BasisOfValue;
use app\models\Methodology;
use app\models\PurposeOfValuation;
use app\models\SectorOverview;
use app\models\Tenure;
use yii\base\Model;

class AddDocumentToBdForm extends Model
{

    public $property_number;
    public $street;
    public $town;
    public $post_code;
    public $post_code_first_part;
    public $client;
    public $borrower;
    public $limited_liability;
    public $same_as_inspection;
    public $valuation_date;
    public $inspection_date;
    public $report_date;
    public $cj_ref;
    public $client_ref;
    public $valuer;
    public $valuer_2;
    public $double_signed;

    public $purpose_of_Valuation_ids;
    public $tenure_ids;
    public $basis_of_value_ids;
    public $sector_overview_ids;
    public $methodology_ids;
    public $appendicies_ids;


    public $tenure_ids_right;
    public $basis_of_value_ids_right;
    public $sector_overview_ids_right;
    public $methodology_ids_right;
    public $appendicies_ids_right;
    public $files;


    public function rules()
    {
        return [
            [['property_number', 'street'], 'required', 'message' => 'поле должно быть заполнено'],
            [
                [
                    'property_number',
                    'street',
                    'town',
                    'post_code',
                    'post_code_first_part',
                    'client',
                    'borrower',
                    'cj_ref',
                    'client_ref',
                    'valuer',
                    'valuer_2',
                ],
                'string',
            ],
            [
                ['report_date', 'inspection_date', 'valuation_date'],
                'date',
                'format'      => 'php:Y-m-d',
                'skipOnEmpty' => false,
            ],
            [
                ['files'],
                'file',
                'maxSize'  => 1024 * 1024 * 0.5,
                'maxFiles' => 4,
                'tooBig'   => 'файл слишком большой',
            ],
            [
                [
                    'same_as_inspection',
                    'tenure_ids',
                    'double_signed',
                    'limited_liability',
                    'purpose_of_Valuation_ids',
                    'basis_of_value_ids',
                    'appendicies_ids',
                    'appendicies_ids_right',
                    'sector_overview_ids',
                    'sector_overview_ids_right',
                    'basis_of_value_ids',
                    'basis_of_value_ids_right',
                    'methodology_ids',
                    'methodology_ids_right',
                ],
                'safe',
            ],


        ];
    }


    public function attributeLabels()
    {
        return [
            'id'                       => 'ID',
            'property_number'          => 'Property Address',
            'street'                   => 'Street',
            'town'                     => 'Town',
            'post_code'                => 'Post Code',
            'post_code_first_part'     => 'Post Code First Part',
            'client'                   => 'Client',
            'borrower'                 => 'Borrower',
            'limited_liability'        => 'Limited Liability',
            'same_as_inspection'       => 'Same As Inspection',
            'valuation_date'           => 'Valuation Date',
            'inspection_date'          => 'Inspection Date',
            'report_date'              => 'Report Date',
            'cj_ref'                   => 'CJ Reference No',
            'client_ref'               => 'Client Ref No',
            'valuer'                   => 'Valuer',
            'valuer_2'                 => 'Valuer  2',
            'double_signed'            => 'Double Signed',
            'purpose_of_Valuation_ids' => 'Purpose of Valuation',
            'tenure_ids'               => 'Tenure',
            'basis_of_value_ids'       => 'Basis of Value',
        ];
    }

    public static function getPurposeOfValuation()
    {
        $PurposeOfValuation = PurposeOfValuation::find()->all();
        $PurposeOfValuationData = [];
        foreach ($PurposeOfValuation as $category) {
            $PurposeOfValuationData[$category->id] = $category->name;
        }

        return $PurposeOfValuationData;
    }

    public static function getTenure()
    {
        $Tenure = Tenure::find()->all();
        $TenureData = [];
        foreach ($Tenure as $category) {
            $TenureData[$category->id] = $category->name;
        }

        return $TenureData;
    }


    public static function getBasisOfValue(array $expectationArray)
    {
        $BasisOfValue = BasisOfValue::find()->all();
        $BasisOfValueData = [];
        foreach ($BasisOfValue as $category) {
            foreach ($expectationArray as $name) {
                if ($category->name === $name) {
                    $BasisOfValueData[$category->id] = $category->name;
                }
            }
        }

        return $BasisOfValueData;
    }

    public static function getSectorOverview(array $expectationArray)
    {
        $SectorOverview = SectorOverview::find()->all();
        $SectorOverviewData = [];
        foreach ($SectorOverview as $category) {
            foreach ($expectationArray as $name) {
                if ($category->name === $name) {
                    $SectorOverviewData[$category->id] = $category->name;
                }
            }
        }

        return $SectorOverviewData;
    }

    public static function getMethodology(array $expectationArray)
    {
        $Methodology = Methodology::find()->all();
        $MethodologyData = [];
        foreach ($Methodology as $category) {
            foreach ($expectationArray as $name) {
                if ($category->name === $name) {
                    $MethodologyData[$category->id] = $category->name;
                }
            }
        }

        return $MethodologyData;
    }

    public static function getAppendicies(array $expectationArray)
    {
        $Appendicies = Appendicies::find()->all();
        $AppendiciesData = [];
        foreach ($Appendicies as $category) {
            foreach ($expectationArray as $name) {
                if ($category->name === $name) {
                    $AppendiciesData[$category->id] = $category->name;
                }
            }
        }

        return $AppendiciesData;
    }
}