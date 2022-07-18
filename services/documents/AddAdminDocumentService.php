<?php

namespace app\services\documents;

use app\models\Documents;
use app\models\DocumentsAppendicies;
use app\models\DocumentsBasisOfValue;
use app\models\DocumentsFiles;
use app\models\DocumentsMethodology;
use app\models\DocumentsPurposeOfValuation;
use app\models\DocumentsSectorOverview;
use app\models\DocumentsTenure;
use app\models\Files;
use app\models\forms\AddDocumentToBdForm;
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

        $basisOfValues = new DocumentsBasisOfValue();
        $basisOfValues->documents_id = 1;
        $basisOfValues->basis_of_value_id = 1;
        $basisOfValues->save();

        if ($addDocumentToBdForm->basis_of_value_ids) {
            foreach ($addDocumentToBdForm->basis_of_value_ids as $key => $basisOfValueId) {
                $basisOfValue = new DocumentsBasisOfValue();
                $basisOfValue->documents_id = $documentId;
                $basisOfValue->basis_of_value_id = $basisOfValueId;
                $basisOfValue->save();
            }
        }
        if ($addDocumentToBdForm->basis_of_value_ids_right) {
            foreach ($addDocumentToBdForm->basis_of_value_ids_right as $key => $basisOfValueId) {
                $basisOfValueRight = new DocumentsBasisOfValue();
                $basisOfValueRight->documents_id = $documentId;
                $basisOfValueRight->basis_of_value_id = $basisOfValueId;
                $basisOfValueRight->save();
            }
        }
        if ($addDocumentToBdForm->sector_overview_ids) {
            foreach ($addDocumentToBdForm->sector_overview_ids as $key => $sectorOverviewId) {
                $sectorOver = new DocumentsSectorOverview();
                $sectorOver->documents_id = $documentId;
                $sectorOver->sector_overview_id = $sectorOverviewId;
                $sectorOver->save();
            }
        }
        if ($addDocumentToBdForm->sector_overview_ids_right) {
            foreach ($addDocumentToBdForm->sector_overview_ids_right as $key => $sectorOverviewId) {
                $sectorOverRight = new DocumentsSectorOverview();
                $sectorOverRight->documents_id = $documentId;
                $sectorOverRight->sector_overview_id = $sectorOverviewId;
                $sectorOverRight->save();
            }
        }
        if ($addDocumentToBdForm->methodology_ids) {
            foreach ($addDocumentToBdForm->methodology_ids as $key => $methodologyId) {
                $methodology = new DocumentsMethodology();
                $methodology->documents_id = $documentId;
                $methodology->methodology_id = $methodologyId;
                $methodology->save();
            }
        }
        if ($addDocumentToBdForm->methodology_ids_right) {
            foreach ($addDocumentToBdForm->methodology_ids_right as $key => $methodologyId) {
                $methodologyRight = new DocumentsMethodology();
                $methodologyRight->documents_id = $documentId;
                $methodologyRight->methodology_id = $methodologyId;
                $methodologyRight->save();
            }
        }
        if ($addDocumentToBdForm->appendicies_ids) {
            foreach ($addDocumentToBdForm->appendicies_ids as $key => $appendiciesId) {
                $appen = new DocumentsAppendicies();
                $appen->documents_id = $documentId;
                $appen->appendicies_id = $appendiciesId;
                $appen->save();
            }
        }
        if ($addDocumentToBdForm->appendicies_ids_right) {
            foreach ($addDocumentToBdForm->appendicies_ids_right as $key => $appendiciesId) {
                $appenRight = new DocumentsAppendicies();
                $appenRight->documents_id = $documentId;
                $appenRight->appendicies_id = $appendiciesId;
                $appenRight->save();
            }
        }
        if ($addDocumentToBdForm->purpose_of_Valuation_ids) {
            $purpur = new DocumentsPurposeOfValuation();
            $purpur->documents_id = $documentId;
            $purpur->purpose_of_valuation_id = $addDocumentToBdForm->purpose_of_Valuation_ids;
            $purpur->save();
        }
        if ($addDocumentToBdForm->purpose_of_Valuation_ids) {
            $tenure = new DocumentsTenure();
            $tenure->documents_id = $documentId;
            $tenure->tenure_id = $addDocumentToBdForm->purpose_of_Valuation_ids;
            $tenure->save();
        }

        $addDocumentToBdForm->files = UploadedFile::getInstances($addDocumentToBdForm, 'files');

        if ($addDocumentToBdForm->files){
            if (!mkdir($concurrentDirectory = "uploadedImg/".(string)$documentId) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
            $path = "uploadedImg/"."$documentId/";
            foreach ($addDocumentToBdForm->files as $file) {
                $fileName = $file->baseName.'.'.$file->extension;

                $file->saveAs(
                    $path.$fileName
                );
                $newFile = new Files();
                $newFile->path = (string)$path.(string)$fileName;
                $newFile->name = (string)$fileName;
                $newFile->save();

                $documentsFile = new DocumentsFiles();
                $documentsFile->files_id = $newFile->getId();
                $documentsFile->documents_id = $documentId;
                $documentsFile->save();
            }
        }
    }

    public function updateDocument($documentId, AddDocumentToBdForm $updateDocumentToBdForm)
    {
        $this->deleteSecondaryData($documentId);
        $this->addDocument($updateDocumentToBdForm, 'update', $documentId);
    }

    public function deleteSecondaryData($documentId)
    {
        $appendicieses = DocumentsAppendicies::find()->where(['documents_id' => $documentId])->all();
        if ($appendicieses) {
            foreach ($appendicieses as $appendiciese) {
                $appendiciese->delete();
            }
        }
        $basisOfValues = DocumentsBasisOfValue::find()->where(['documents_id' => $documentId])->all();
        if ($basisOfValues) {
            foreach ($basisOfValues as $basisOfValue) {
                $basisOfValue->delete();
            }
        }
        $methodologies = DocumentsMethodology::find()->where(['documents_id' => $documentId])->all();
        if ($methodologies) {
            foreach ($methodologies as $methodology) {
                $methodology->delete();
            }
        }
        $purposes = DocumentsPurposeOfValuation::find()->where(['documents_id' => $documentId])->all();

        if ($purposes) {
            foreach ($purposes as $purpose) {
                $purpose->delete();
            }
        }
        $sectors = DocumentsSectorOverview::find()->where(['documents_id' => $documentId])->all();
        if ($sectors) {
            foreach ($sectors as $sector) {
                $sector->delete();
            }
        }
        $tenures = DocumentsTenure::find()->where(['documents_id' => $documentId])->all();
        if ($tenures) {
            foreach ($tenures as $tenure) {
                $tenure->delete();
            }
        }
    }

    public function deleteDocument($documentId)
    {
        $document = Documents::find()->where(['id' => $documentId])->one();
        $this->deleteSecondaryData($documentId);

        $document->delete();
    }


}