<?php

namespace app\services\documents;

use app\models\Documents;
use app\models\DocumentsDocx;
use app\models\DocumentsFiles;
use app\models\Docx;
use app\models\Files;
use app\models\forms\AddDocumentToBdForm;
use app\models\SectorOverview;
use app\services\referenceTables\AppendiciesService;
use app\services\referenceTables\BasisOfValueService;
use app\services\referenceTables\DocxService;
use app\services\referenceTables\FilesService;
use app\services\referenceTables\MethodologyService;
use app\services\referenceTables\PurposeOfValuationService;
use app\services\referenceTables\SectorOverviewService;
use app\services\referenceTables\TenureService;
use yii\helpers\Url;
use yii\web\UploadedFile;

class AddAdminDocumentService
{
    public function addDocument(AddDocumentToBdForm $addDocumentToBdForm, $params, $documentId = null)
    {
        if ($params === 'add') {
            $document = new Documents();
        } elseif ($params === 'update') {
            $document = Documents::find()->where(['id' => $documentId])->one();
        }

        $document->property_number = $addDocumentToBdForm->property_number;
        $document->street = $addDocumentToBdForm->street;
        $document->town = $addDocumentToBdForm->town;
        $document->post_code = $addDocumentToBdForm->post_code;
        $document->post_code_first_part = $addDocumentToBdForm->post_code_first_part;
        $document->client = $addDocumentToBdForm->client;
        $document->borrower = $addDocumentToBdForm->borrower;
        $document->limited_liability = $addDocumentToBdForm->limited_liability;
        $document->same_as_inspection = $addDocumentToBdForm->same_as_inspection;
        $document->valuation_date = $addDocumentToBdForm->valuation_date;
        $document->inspection_date = $addDocumentToBdForm->inspection_date;
        $document->report_date = $addDocumentToBdForm->report_date;
        $document->cj_ref = $addDocumentToBdForm->cj_ref;
        $document->client_ref = $addDocumentToBdForm->client_ref;
        $document->valuer = $addDocumentToBdForm->valuer;
        $document->valuer_2 = $addDocumentToBdForm->valuer_2;
        $document->double_signed = $addDocumentToBdForm->double_signed;
        $document->save();
        $documentId = $document->getId();
        $doc = Documents::find()->where(['id' => $documentId])->one();


        if ($addDocumentToBdForm->basis_of_value_ids || $addDocumentToBdForm->basis_of_value_ids_right) {
            $basisOfValue = new  BasisOfValueService($doc);
            $basisOfValue->addBasisOfValue($addDocumentToBdForm);
        }

        if ($addDocumentToBdForm->sector_overview_ids || $addDocumentToBdForm->sector_overview_ids_right) {
            $sectorOverview = new SectorOverviewService($doc);
            $sectorOverview->addSectorOverview($addDocumentToBdForm);
        }

        if ($addDocumentToBdForm->methodology_ids || $addDocumentToBdForm->methodology_ids_right) {
            $methodology = new MethodologyService($doc);
            $methodology->addMethodology($addDocumentToBdForm);
        }


        if ($addDocumentToBdForm->appendicies_ids || $addDocumentToBdForm->appendicies_ids_right) {
            $appendicies = new AppendiciesService($doc);
            $appendicies->addAppendicies($addDocumentToBdForm);
        }


        if ($addDocumentToBdForm->purpose_of_Valuation_ids) {
            $purpur = new PurposeOfValuationService($doc);
            $purpur->addPurposeOfValuation($addDocumentToBdForm);
        }

        if ($addDocumentToBdForm->tenure_ids) {
            $tenure = new TenureService($doc);
            $tenure->addTenure($addDocumentToBdForm);
        }


        $addDocumentToBdForm->files = UploadedFile::getInstances($addDocumentToBdForm, 'files');
        $files = new FilesService($doc);
        if ($addDocumentToBdForm->files) {

            $files->addFile($addDocumentToBdForm);
        }


        $files->createDocx();

        return $documentId;
    }


    public function updateDocument($documentId, AddDocumentToBdForm $updateDocumentToBdForm)
    {

        $this->deleteSecondaryData($documentId);
        $this->addDocument($updateDocumentToBdForm, 'update', $documentId);

    }


    public function deleteSecondaryData(Documents $document)
    {

        AppendiciesService::deleteAppendicies($document);

        BasisOfValueService::deleteBasisOfValue($document);

        MethodologyService::deleteMethodology($document);

        PurposeOfValuationService::deletePurposeOfValution($document);

        SectorOverviewService::deleteSectorOverview($document);

        TenureService::deleteTenure($document);

        $deleteSecondoryFiles = new FilesService($document);
        $deleteSecondoryFiles->deleteSecondaryFiles();


    }



    public function deleteDocument($documentId)
    {
        $document = Documents::find()->where(['id' => $documentId])->one();

        $this->deleteSecondaryData($document);

        $document->delete();
    }


}