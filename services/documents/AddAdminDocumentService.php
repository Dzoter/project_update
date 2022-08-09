<?php

namespace app\services\documents;

use app\models\Documents;
use app\models\DocumentsAppendicies;
use app\models\DocumentsBasisOfValue;
use app\models\DocumentsDocx;
use app\models\DocumentsFiles;
use app\models\DocumentsMethodology;
use app\models\DocumentsPurposeOfValuation;
use app\models\DocumentsSectorOverview;
use app\models\DocumentsTenure;
use app\models\Docx;
use app\models\Files;
use app\models\forms\AddDocumentToBdForm;
use app\models\SectorOverview;
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
        if ($addDocumentToBdForm->tenure_ids) {
            $tenure = new DocumentsTenure();
            $tenure->documents_id = $documentId;
            $tenure->tenure_id = $addDocumentToBdForm->tenure_ids;
            $tenure->save();
        }

        $addDocumentToBdForm->files = UploadedFile::getInstances($addDocumentToBdForm, 'files');


        if ($addDocumentToBdForm->files) {
            if (!mkdir($concurrentDirectory = "uploadedImg/".(string)$documentId) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }


            $path = "uploadedImg/"."$documentId/";
            $fileIteration = 0;
            foreach ($addDocumentToBdForm->files as $file) {


                if ($addDocumentToBdForm->fileName[$fileIteration]){
                    $ImgFileName = $addDocumentToBdForm->fileName[$fileIteration].'.'.$file->extension;
                    ++$fileIteration;
                } else {
                    $ImgFileName = $file->name.'.'.$file->extension;

                }


                $file->saveAs(
                    $path.$ImgFileName
                );
                $newFile = new Files();
                $newFile->path = (string)$path.(string)$ImgFileName;
                $newFile->name = (string)$ImgFileName;
                $newFile->save();

                $documentsFile = new DocumentsFiles();
                $documentsFile->files_id = $newFile->getId();
                $documentsFile->documents_id = $documentId;
                $documentsFile->save();
            }

        }
            if (file_exists(Url::to("@app/web/uploadDocx/$documentId/review_full.docx"))){
                unlink(Url::to("@app/web/uploadDocx/$documentId/review_full.docx"));
            }
            $doc = Documents::find()->where(['id'=>$documentId])->one();
            $this->createDocx($doc);
            return $documentId;
    }



    public function updateDocument($documentId, AddDocumentToBdForm $updateDocumentToBdForm)
    {
        $this->deleteDocxFile($documentId);
        $this->deleteSecondaryData($documentId);
        $documentId = $this->addDocument($updateDocumentToBdForm, 'update', $documentId);
        $document = Documents::find()->where(['id'=>$documentId])->one();
        $this->updateDocx($document);
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
        $docx = DocumentsDocx::find()->where(['documents_id'=>$documentId])->one();
        $docx->delete();
       $files = DocumentsFiles::find()->where(['documents_id'=>$documentId])->all();
        if ($files) {
            foreach ($files as $file) {
                $file->delete();
            }
        }
        $pathOfFiles = "uploadedimg/$documentId/";
        $this->deleteSecondaryFiles($pathOfFiles);
        $pathOfDocx = "uploadDocx/$documentId/";
        $this->deleteSecondaryFiles($pathOfDocx);

    }
    public function deleteSecondaryFiles($pathOfFiles){


        if (is_dir($pathOfFiles) === true)
        {
            $files = array_diff(scandir($pathOfFiles), array('.', '..'));

            foreach ($files as $file)
            {
                unlink(realpath($pathOfFiles) . '/' . $file);
            }

            return rmdir($pathOfFiles);
        }

        if (is_file($pathOfFiles) === true)
        {
            return unlink($pathOfFiles);
        }

        return false;

    }

    public function deleteDocument($documentId)
    {
        $document = Documents::find()->where(['id' => $documentId])->one();
        $this->deleteSecondaryData($documentId);

        $document->delete();
    }

    public function createDocx( Documents $document)
    {

        $docx = new \PhpOffice\PhpWord\TemplateProcessor(Url::to('@app/web/uploadDocx/reviews.docx'));
        $uploadDir = __DIR__;



        $docx->setValue('property_number', $document->property_number);
        $docx->setValue('street',$document->street);
        $docx->setValue('town', $document->town);
        $docx->setValue('post_code', $document->post_code);
        $docx->setValue('client', $document->client);
        $docx->setValue('valuation_date',date("jS F Y",strtotime($document->valuation_date)) );
        $docx->setValue('cj_ref', $document->cj_ref);
        $docx->setValue('clinet_ref', $document->client_ref);


        $docx->setValue('borrower', $document->borrower);
        $docx->setValue('tenure', implode('',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoTenure
        ($document->id)));
        $docx->setValue('post_code_first_part', $document->post_code_first_part);
        $docx->setValue('purpose_of_valuation', implode('',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse
        ($document->id)));
        $docx->setValue('valuer', $document->valuer);
        $docx->setValue('valuer_2', $document->valuer_2);
        $docx->setValue('inspection_date',date("jS F Y",strtotime($document->inspection_date)) );
        $docx->setValue('report_date',date("jS F Y",strtotime($document->report_date)) );

        /*EXECUTIVE SUMMARY*/



        if(implode('',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse($document->id)) === 'Loan Security'){
            $docx->cloneBlock('borrower_exec', 1, true, true);
            $docx->cloneBlock('suit_for_ls', 1, true, true);
        }else{
            $docx->cloneBlock('borrower_exec', 0, true, true);
            $docx->cloneBlock('suit_for_ls', 0, true, true);
        }

        /*EXECUTIVE SUMMARY*/


        $appendices = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoAppendicies($document->id);
        $append_i = 1;
        $append = array();
        foreach ($appendices as $value)
        {
            $append[] = array('append_id' => $append_i, 'app' => $value);
            $append_i++;
        }
        $docx->cloneBlock('appendices', 0, true, false, $append);



        /*TENURE*/

        $tenure = implode('',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoTenure($document->id));
        if($tenure === 'Freehold'){
            $docx->cloneBlock('tenure_freehold', 1, true, true);
            $docx->cloneBlock('tenure_long_leasehold', 0, true, true);
            $docx->cloneBlock('tenure_leasehold', 0, true, true);
        }elseif($tenure === 'Long Leasehold'){
            $docx->cloneBlock('tenure_long_leasehold', 1, true, true);
            $docx->cloneBlock('tenure_freehold', 0, true, true);
            $docx->cloneBlock('tenure_leasehold', 0, true, true);
        }elseif($tenure === 'Leasehold'){
            $docx->cloneBlock('tenure_leasehold', 1, true, true);
            $docx->cloneBlock('tenure_freehold', 0, true, true);
            $docx->cloneBlock('tenure_long_leasehold', 0, true, true);
        }

        /*TENURE*/


        /*Valuation Basis*/


        $basisValues = implode(',',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis($document->id));
















        if (!strpos($basisValues, 'Market Value')) {
            $docx->deleteBlock('vb_mar');
        }

        $arrayBasicValues = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis($document->id);

        if (in_array('Market Value', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_t', 1, true, true);
            $docx->cloneBlock('vb_mar', 1, true, true);
        } else{
            $docx->cloneBlock('vb_mar_t', 0, true, true);
            $docx->cloneBlock('vb_mar', 0, true, true);
        }
        if (in_array('Market Value (special assumption vacant posession)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_vac_poss_t', 1, true, true);
            $docx->cloneBlock('vb_mar_vac_poss', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_vac_poss_t', 0, true, true);
            $docx->cloneBlock('vb_mar_vac_poss', 0, true, true);
        }
        if (in_array('Market Value (special assumption 180 days)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_180_t', 1, true, true);
            $docx->cloneBlock('vb_mar_180', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_180_t', 0, true, true);
            $docx->cloneBlock('vb_mar_180', 0, true, true);
        }
        if (in_array('Market Rent', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_rent_t', 1, true, true);
            $docx->cloneBlock('vb_mar_rent', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_rent_t', 0, true, true);
            $docx->cloneBlock('vb_mar_rent', 0, true, true);
        }
        if (in_array('Reinstatememnt Value', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_reinst_t', 1, true, true);
            $docx->cloneBlock('vb_mar_reinst', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_reinst_t', 0, true, true);
            $docx->cloneBlock('vb_mar_reinst', 0, true, true);
        }

        if (in_array('Market Value (special assumption 90 days)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_90', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_90', 0, true, true);
        }

        if (in_array('Market Value (1)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_1', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_1', 0, true, true);
        }
        if (in_array('Market Value (2)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_2', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_2', 0, true, true);
        }
        if (in_array('Market Value (3)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_3', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_3', 0, true, true);
        }

        if (in_array('Gross Development Value', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_gross', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_gross', 0, true, true);
        }
        if (in_array('EUV-SH', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_eus', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_eus', 0, true, true);
        }

        if (in_array('Aggregate Market Value (MV-VP)', $arrayBasicValues, true)){
            $docx->cloneBlock('vb_mar_aggr', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_aggr', 0, true, true);
        }









        /*TENURE*/


        $docx->cloneBlock('tenure_freehold', 1, true, true);
        $docx->cloneBlock('tenure_long_leasehold', 1, true, true);
        $docx->cloneBlock('tenure_leasehold', 1, true, true);


        /*TENURE*/



        /*Sector Overview*/


        $sector_overview = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoSector($document->id);
        $sector = [];
        if ($sector_overview){
            $sectorNumber = 0;

            foreach ($sector_overview as $value)
            {
                $sectorInfo = SectorOverview::find()->where(['name'=>$value])->one();
                $sector[$sectorNumber] = ['sec_val'=>$sectorInfo->info];
                ++$sectorNumber;
            }

            $countSectorOverview = count($sector);


            $docx->cloneBlock('sector_overview', 0, true, false,$sector);
        } else {
            $docx->cloneBlock('sector_overview', 0, true, false, $sector);
        }




        /*Sector Overview*/


        if(implode(',',GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse($document->id)) === 'Loan Security'){
            $docx->cloneBlock('loan_security', 1, true, true);
        }else{
            $docx->cloneBlock('loan_security', 0, true, true);
        }


        if($document->limited_liability){
            $docx->cloneBlock('limited_liability', 1, true, true);
        }else{
            $docx->cloneBlock('limited_liability', 0, true, true);
        }



        if($document->double_signed){
            $docx->cloneBlock('no_double', 0, true, true);
            $docx->cloneBlock('double', 1, true, true);
        }else{
            $docx->cloneBlock('no_double', 1, true, true);
            $docx->cloneBlock('double', 0, true, true);
        }



        $appendices_bot = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoAppendicies($document->id);
        $append_i_bot = 1;
        $append_bot = array();
        foreach ($appendices_bot as $value)
        {
            $append_bot[] = array('append_id' => $append_i_bot, 'app' => $value);
            $append_i_bot++;
        }
        $docx->cloneBlock('appendices_bot', 0, true, false, $append);



        $vanilArray = array(0,1,2,3,4,5,6,7,8,9);
        if (GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoFiles($document->id)){
            $photoArr = array();
            foreach (GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoFiles($document->id) as $id => $value){
                $photoArr[] = $value;
            }


            $fileNumber = 1;

            $fileNumberLeftSide = 0;
            $fileNumberRightSide = 0;
            $arrayOfDockNumbersLeft = array();
            $arrayOfDockNumbersRight = array();



            foreach ($photoArr as $photoObj){

                if (!(($fileNumber%2)===0)){

                    $docx->setValue("files_name_left_$fileNumberLeftSide",$photoObj->name);
                    $docx->setImageValue("files_path_left_$fileNumberLeftSide",['path'=>Url::to("@app/web/$photoObj->path"),'width'=>'500',
                                                                  'height'=>'200']);

                    $docx->cloneBlock("files_left_$fileNumberLeftSide",1, true, false);
                    $arrayOfDockNumbersLeft[] = $fileNumberLeftSide;

                    $mayBeForNullImg = $fileNumberLeftSide;
                    ++$fileNumberLeftSide;
                } else{
                    $docx->setValue("files_name_right_$fileNumberRightSide",$photoObj->name);


                    $docx->setImageValue("files_path_right_$fileNumberRightSide",['path'=>Url::to("@app/web/$photoObj->path"),'width'=>'500',
                                                                  'height'=>'200']);

                    $arrayOfDockNumbersRight[] = $fileNumberRightSide;
                    ++$fileNumberRightSide;
                }

                ++$fileNumber;

            }
            $docx->setValue("files_name_right_$mayBeForNullImg",'photo may be here');
            $docx->setValue("files_path_right_$mayBeForNullImg",'');

            $resultArrayLeft = array_diff($vanilArray,$arrayOfDockNumbersLeft);



            foreach ($resultArrayLeft as $number){
                $docx->cloneBlock("files_left_$number", 0, true, true);

            }
            foreach ($vanilArray as $number){
                $docx->cloneBlock("files_left_$number", 0,true,true);

            }

        } else {

        $docx->cloneBlock("files_left_0", 0,true,false);
        $docx->cloneBlock("files_left_1", 0,true,false);
        $docx->cloneBlock("files_left_2", 0,true,false);
        $docx->cloneBlock("files_left_3", 0,true,false);
        $docx->cloneBlock("files_left_4", 0,true,false);
        $docx->cloneBlock("files_left_5", 0,true,false);
        $docx->cloneBlock("files_left_6", 0,true,false);
        $docx->cloneBlock("files_left_7", 0,true,false);
        $docx->cloneBlock("files_left_8", 0,true,false);
        $docx->cloneBlock("files_left_9", 0,true,false);

        }








        $outputFille = 'review_full.docx';

        $docx->saveAs($outputFille);

        // файл, который нужно перенести
        $oldFilePath = Url::to('@app/web/review_full.docx');
// новый путь этого файла
        $newFilePath = Url::to("@app/web/uploadDocx/$document->id/review_full.docx");

// Получаем адрес директории нового пути
        $newFolderPath = pathinfo($newFilePath)["dirname"];

// смотрим, есть ли нужная новая директория или пытаемся её создать
        if(file_exists($newFolderPath) || mkdir($newFolderPath, 0777, true) || is_dir($newFolderPath))
        {
            // перемещаем
            rename($oldFilePath, $newFilePath);
        }
        $newDocx = new Docx();
        $newDocx->path = "uploadDocx/$document->id/review_full.docx";
        $newDocx->save();
        $newDocumentDocx = new DocumentsDocx();
        $newDocumentDocx->documents_id = $document->id;
        $newDocumentDocx->docx_id = $newDocx->getId();
        $newDocumentDocx->save();

    }

    public function deleteDocxFile($documentId){

        $documentDocx = DocumentsDocx::find()->where(['documents_id'=>$documentId])->one();
        $docx = Docx::find()->where(['id'=>$documentDocx->docx_id])->one();
        return unlink(Url::to("@app/web/$docx->path"));
    }
    public function updateDocx(Documents $documents){
        $this->deleteDocxFile($documents->id);
        $this->createDocx($documents);
    }
}