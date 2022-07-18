<?php

namespace app\services\documents;

use app\models\Appendicies;
use app\models\BasisOfValue;
use app\models\Documents;
use app\models\Files;
use app\models\Methodology;
use app\models\PurposeOfValuation;
use app\models\SectorOverview;
use app\models\Tenure;

class GetAllSecondaryInfoOfDocumentsService
{

    public static function getSecondaryInfoMethodology($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $idsData = [];
        $secondaryData = [];
        if ($document->documentsMethodologies){

            foreach ($document->documentsMethodologies as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->methodology_id;
            }

            foreach ($idsData as $id){
                $table = Methodology::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }

        }
        return $secondaryData;
    }
    public static function getSecondaryInfoAppendicies($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $idsData = [];
        $secondaryData = [];
        if ($document->documentsAppendicies){
            foreach ($document->documentsAppendicies as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->appendicies_id;
            }
            foreach ($idsData as $id){
                $table = Appendicies::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }
        }
        return $secondaryData;
    }
    public static function getSecondaryInfoBasis($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $secondaryData = [];
        $idsData = [];

        if ($document->documentsBasisOfValues){
            foreach ($document->documentsBasisOfValues as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->basis_of_value_id;
            }
            foreach ($idsData as $id){
                $table = BasisOfValue::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }

        }
        return $secondaryData;
    }
    public static function getSecondaryInfoPurporse($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();


        $secondaryData = [];
        $idsData = [];

        if ($document->documentsPurposeOfValuations){
            foreach ($document->documentsPurposeOfValuations as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->purpose_of_valuation_id;
            }
            foreach ($idsData as $id){
                $table = PurposeOfValuation::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }

        }
        return $secondaryData;
    }

    public static function getSecondaryInfoSector($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $secondaryData = [];
        $idsData = [];

        if ($document->documentsSectorOverviews){
            foreach ($document->documentsSectorOverviews as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->sector_overview_id;
            }
            foreach ($idsData as $id){
                $table = SectorOverview::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }

        }
        return $secondaryData;
    }
    public static function getSecondaryInfoTenure($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $secondaryData = [];
        $idsData = [];

        if ($document->documentsTenures){
            foreach ($document->documentsTenures as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->tenure_id;
            }
            foreach ($idsData as $id){
                $table = Tenure::find()->where(['id'=>$id])->one();
                $secondaryData[$table->id]=$table->name;
            }

        }
        return $secondaryData;
    }

    public static function getSecondaryInfoFiles($documentId)
    {
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $secondaryData = [];
        $idsData = [];

        if ($document->documentsFiles){
            foreach ($document->documentsFiles as $secondaryTables => $secondaryTable){
                $idsData[] = $secondaryTable->files_id;
            }
            foreach ($idsData as $id){
                $table = Files::find()->where(['id'=>$id])->one();
                $secondaryData[] = $table;
            }

        }
        return $secondaryData;
    }

}