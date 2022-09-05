<?php

namespace app\services\referenceTables;

use app\models\DocumentsDocx;
use app\models\DocumentsFiles;
use app\models\DocumentsPdf;
use app\models\Docx;
use app\models\Files;
use app\models\forms\AddDocumentToBdForm;
use app\models\Pdf;
use app\models\SectorOverview;
use app\services\documents\ApiService;
use app\services\documents\GetAllSecondaryInfoOfDocumentsService;
use RobGridley\Ghostscript\Devices;
use RobGridley\Ghostscript\Ghostscript;
use RobGridley\Ghostscript\RealFile;
use yii\helpers\Url;

class FilesService extends AbstractReferenceTable
{
    public function addFile(AddDocumentToBdForm $addDocumentToBdForm)
    {
        if (!file_exists(Url::to("@app/web/uploadedImg/"))) {
            mkdir(Url::to('@app/web/uploadedImg/'), 0777, true);
        }

        if (!file_exists(Url::to("@app/web/uploadedPdf/"))) {
            mkdir(Url::to('@app/web/uploadedPdf/'), 0777, true);
        }

        foreach ($addDocumentToBdForm->files as $file) {
            $fileName = array_shift($addDocumentToBdForm->fileName);

            if ($file->type === 'image/jpeg' || $file->type === 'image/png') {
                $this->addImg($file, $fileName);
            } elseif ($file->type === 'application/pdf') {
                $this->addPdf($file, $fileName);
            }
        }
        $this->convertPdfToImg();
    }


    protected function addImg($file, $fileName)
    {
        if (!file_exists(Url::to("@app/web/uploadedImg/".(string)$this->document->id))) {
            if (!mkdir($concurrentDirectory = "uploadedImg/".(string)$this->document->id)
                && !is_dir
                (
                    $concurrentDirectory
                )
            ) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $path = "uploadedImg/".$this->document->id."/";


        $ImgFileName = $fileName.'.'.pathinfo($file)['extension'];

        $file->saveAs(
            $path.$ImgFileName
        );
        $newFile = new Files();
        $newFile->path = (string)$path.(string)$ImgFileName;
        $newFile->name = (string)$ImgFileName;
        $newFile->save();

        $documentsFile = new DocumentsFiles();
        $documentsFile->files_id = $newFile->getId();
        $documentsFile->documents_id = $this->document->id;
        $documentsFile->save();
    }

    protected function addPdf($file, $fileName)
    {
        if (!file_exists(Url::to("@app/web/uploadedPdf/".(string)$this->document->id))) {
            if (!mkdir($concurrentDirectory = "uploadedPdf/".(string)$this->document->id)
                && !is_dir
                (
                    $concurrentDirectory
                )
            ) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $path = "uploadedPdf/".$this->document->id."/";

        $pdfFileName = $fileName.'.'.pathinfo($file)['extension'];

        $file->saveAs(
            $path.$pdfFileName
        );

        $newFile = new Pdf();
        $newFile->path = (string)$path.(string)$pdfFileName;
        $newFile->name = (string)$pdfFileName;
        $newFile->save();

        $documentsPdf = new DocumentsPdf();
        $documentsPdf->pdf_id = $newFile->getId();
        $documentsPdf->documents_id = $this->document->id;
        $documentsPdf->save();
    }

    protected function convertPdfToImg()
    {
        $pdfs = DocumentsPdf::find()->where(['documents_id' => $this->document->id])->all();
        $iteration = 1;

        foreach ($pdfs as $pdf) {
            $pdfFile = Pdf::find()->where(['id' => $pdf->pdf_id])->one();

            if (!file_exists(Url::to("@app/web/uploadedPdf/".(string)$this->document->id.'/'.(string)$iteration))) {
                if (!mkdir(
                        $concurrentDirectory = "uploadedPdf/".(string)$this->document->id.'/'.(string)$iteration,
                        0700
                    )
                    && !is_dir($concurrentDirectory)
                ) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
                }
            }



            $device = new Devices\Png24;
            $device->setDownScaleFactor(2);

            $gs = new Ghostscript($device);
            $gs->setPageBox('trim');
            $gs->setResolution(144);


            $file = new RealFile(Url::to('@app/web/uploadedPdf/'.$this->document->id.'/'.$pdfFile->name));
            $i = 1;
            while ($image = $gs->convert($file, $i)) {
                file_put_contents(
                    Url::to('@app/web/uploadedPdf/'.$this->document->id."/".(string)$iteration.'/'.$i.'.jpg'),
                    $image
                );

                $newImgFromPdf = new Pdf();
                $newImgFromPdf->name = (string)$i;
                $newImgFromPdf->path = 'uploadedPdf/'.$this->document->id."/".(string)$iteration.'/'.$i.'.jpg';
                $newImgFromPdf->save();


                $newImagesFromPdf = new DocumentsPdf();
                $newImagesFromPdf->pdf_id = $newImgFromPdf->getId();
                $newImagesFromPdf->documents_id = $this->document->id;
                $newImagesFromPdf->save();

                $i++;
            }
            $iteration++;
            unlink(Url::to('@app/web/uploadedPdf/'.$this->document->id.'/'.$pdfFile->name));
            $pdf->delete();
            $pdfFile->delete();
        }
    }

    public function deleteSecondaryFiles()
    {
        $documentFiles = DocumentsFiles::find()->where(['documents_id' => $this->document->id])->all();
        if ($documentFiles) {
            $this->deleteImg($documentFiles);
        }
        $documentDocx = DocumentsDocx::find()->where(['documents_id' => $this->document->id])->one();
        if ($documentDocx) {
            $this->deleteDocx();
        }
        $documentPdf = DocumentsPdf::find()->where(['documents_id' => $this->document->id])->all();
        if ($documentPdf) {
            $this->deletePdf($documentPdf);
        }
    }

    private function deleteDocx()
    {
        $documentDocx = DocumentsDocx::find()->where(['documents_id' => $this->document->id])->one();
        $docx = Docx::find()->where(['id' => $documentDocx->docx_id])->one();
        $documentDocx->delete();
        $docx->delete();
        $this->deleteFiles('docx');
    }

    private function deleteImg($documentFiles)
    {
        foreach ($documentFiles as $documentFile) {
            $file = Files::find()->where(['id' => $documentFile->files_id])->one();
            $documentFile->delete();
            $file->delete();
        }
        $this->deleteFiles('img');
    }

    private function deletePdf($documentsPdfs)
    {
        foreach ($documentsPdfs as $documentsPdf) {
            $pdf = Pdf::find()->where(['id' => $documentsPdf->pdf_id])->one();
            $documentsPdf->delete();
            $pdf->delete();
        }
        $this->deleteFiles('pdf');
    }


    private function deleteFiles($type)
    {
        if ($type === 'img' || $type === 'docx') {
            if ($type === 'img') {
                $pathOfFiles = "uploadedimg/".$this->document->id."/";
            } elseif ($type === 'docx') {
                $pathOfFiles = "uploadDocx/".$this->document->id."/";
            }

            if (is_dir($pathOfFiles) === true) {
                $files = array_diff(scandir($pathOfFiles), array('.', '..'));

                foreach ($files as $file) {
                    unlink(realpath($pathOfFiles).'/'.$file);
                }

                return rmdir($pathOfFiles);
            }

            if (is_file($pathOfFiles) === true) {
                return unlink($pathOfFiles);
            }

            return false;
        }

        if ($type === 'pdf') {
            $pathOfFiles = "uploadedPdf/".$this->document->id."/";
            if (is_dir($pathOfFiles) === true) {
                $directories = array_diff(scandir($pathOfFiles), array('.', '..'));


                foreach ($directories as $directory) {
                    $directoryWithFiles = array_diff(scandir($pathOfFiles.'/'.$directory), array('.', '..'));
                    foreach ($directoryWithFiles as $file) {
                        unlink(realpath($pathOfFiles.'/'.$directory).'/'.$file);
                    }
                    rmdir($pathOfFiles.'/'.$directory);
                }

                return rmdir($pathOfFiles);
            }


            return false;
        }

        return false;
    }


    public function createDocx()
    {
        if (file_exists(Url::to("@app/web/uploadDocx/".$this->document->id."/review_full.docx"))) {
            unlink(Url::to("@app/web/uploadDocx/".$this->document->id."/review_full.docx"));
        }

        $docx = new \PhpOffice\PhpWord\TemplateProcessor(Url::to('@app/web/uploadDocx/reviews.docx'));
        $uploadDir = __DIR__;


        $docx->setValue('property_number', $this->document->property_number);
        $docx->setValue('street', $this->document->street);
        $docx->setValue('town', $this->document->town);
        $docx->setValue('post_code', $this->document->post_code);
        $docx->setValue('client', $this->document->client);
        $docx->setValue('valuation_date', date("jS F Y", strtotime($this->document->valuation_date)));
        $docx->setValue('cj_ref', $this->document->cj_ref);
        $docx->setValue('clinet_ref', $this->document->client_ref);


        $docx->setValue('borrower', $this->document->borrower);
        $docx->setValue(
            'tenure',
            implode(
                '',
                GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoTenure
                (
                    $this->document->id
                )
            )
        );
        $docx->setValue('post_code_first_part', $this->document->post_code_first_part);
        $docx->setValue(
            'purpose_of_valuation',
            implode(
                '',
                GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse
                (
                    $this->document->id
                )
            )
        );
        $docx->setValue('valuer', $this->document->valuer);
        $docx->setValue('valuer_2', $this->document->valuer_2);
        $docx->setValue('inspection_date', date("jS F Y", strtotime($this->document->inspection_date)));
        $docx->setValue('report_date', date("jS F Y", strtotime($this->document->report_date)));

        /*EXECUTIVE SUMMARY*/


        if (implode('', GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse($this->document->id))
            === 'Loan Security'
        ) {
            $docx->cloneBlock('borrower_exec', 1, true, true);
            $docx->cloneBlock('suit_for_ls', 1, true, true);
        } else {
            $docx->cloneBlock('borrower_exec', 0, true, true);
            $docx->cloneBlock('suit_for_ls', 0, true, true);
        }

        /*EXECUTIVE SUMMARY*/


        $appendices = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoAppendicies($this->document->id);
        $append_i = 1;
        $append = array();
        foreach ($appendices as $value) {
            $append[] = array('append_id' => $append_i, 'app' => $value);
            $append_i++;
        }
        $docx->cloneBlock('appendices', 0, true, false, $append);


        /*TENURE*/

        $tenure = implode('', GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoTenure($this->document->id));
        if ($tenure === 'Freehold') {
            $docx->cloneBlock('tenure_freehold', 1, true, true);
            $docx->cloneBlock('tenure_long_leasehold', 0, true, true);
            $docx->cloneBlock('tenure_leasehold', 0, true, true);
        } elseif ($tenure === 'Long Leasehold') {
            $docx->cloneBlock('tenure_long_leasehold', 1, true, true);
            $docx->cloneBlock('tenure_freehold', 0, true, true);
            $docx->cloneBlock('tenure_leasehold', 0, true, true);
        } elseif ($tenure === 'Leasehold') {
            $docx->cloneBlock('tenure_leasehold', 1, true, true);
            $docx->cloneBlock('tenure_freehold', 0, true, true);
            $docx->cloneBlock('tenure_long_leasehold', 0, true, true);
        }

        /*TENURE*/


        /*Valuation Basis*/


        $basisValues = implode(',', GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis($this->document->id));




        if (!strpos($basisValues, 'Market Value')) {
            $docx->deleteBlock('vb_mar');
        }

        $arrayBasicValues = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis($this->document->id);

        if (in_array('Market Value', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_t', 1, true, true);
            $docx->cloneBlock('vb_mar', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_t', 0, true, true);
            $docx->cloneBlock('vb_mar', 0, true, true);
        }
        if (in_array('Market Value (special assumption vacant posession)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_vac_poss_t', 1, true, true);
            $docx->cloneBlock('vb_mar_vac_poss', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_vac_poss_t', 0, true, true);
            $docx->cloneBlock('vb_mar_vac_poss', 0, true, true);
        }
        if (in_array('Market Value (special assumption 180 days)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_180_t', 1, true, true);
            $docx->cloneBlock('vb_mar_180', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_180_t', 0, true, true);
            $docx->cloneBlock('vb_mar_180', 0, true, true);
        }
        if (in_array('Market Rent', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_rent_t', 1, true, true);
            $docx->cloneBlock('vb_mar_rent', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_rent_t', 0, true, true);
            $docx->cloneBlock('vb_mar_rent', 0, true, true);
        }
        if (in_array('Reinstatememnt Value', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_reinst_t', 1, true, true);
            $docx->cloneBlock('vb_mar_reinst', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_reinst_t', 0, true, true);
            $docx->cloneBlock('vb_mar_reinst', 0, true, true);
        }

        if (in_array('Market Value (special assumption 90 days)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_90', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_90', 0, true, true);
        }

        if (in_array('Market Value (1)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_1', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_1', 0, true, true);
        }
        if (in_array('Market Value (2)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_2', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_2', 0, true, true);
        }
        if (in_array('Market Value (3)', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_3', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_3', 0, true, true);
        }

        if (in_array('Gross Development Value', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_gross', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_gross', 0, true, true);
        }
        if (in_array('EUV-SH', $arrayBasicValues, true)) {
            $docx->cloneBlock('vb_mar_eus', 1, true, true);
        } else {
            $docx->cloneBlock('vb_mar_eus', 0, true, true);
        }

        if (in_array('Aggregate Market Value (MV-VP)', $arrayBasicValues, true)) {
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


        $sector_overview = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoSector($this->document->id);
        $sector = [];
        if ($sector_overview) {
            $sectorNumber = 0;

            foreach ($sector_overview as $value) {
                $sectorInfo = SectorOverview::find()->where(['name' => $value])->one();
                $sector[$sectorNumber] = ['sec_val' => $sectorInfo->info];
                ++$sectorNumber;
            }

            $countSectorOverview = count($sector);


            $docx->cloneBlock('sector_overview', 0, true, false, $sector);
        } else {
            $docx->cloneBlock('sector_overview', 0, true, false, $sector);
        }


        /*Sector Overview*/


        if (implode(',', GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse($this->document->id))
            === 'Loan Security'
        ) {
            $docx->cloneBlock('loan_security', 1, true, true);
        } else {
            $docx->cloneBlock('loan_security', 0, true, true);
        }


        if ($this->document->limited_liability) {
            $docx->cloneBlock('limited_liability', 1, true, true);
        } else {
            $docx->cloneBlock('limited_liability', 0, true, true);
        }


        if ($this->document->double_signed) {
            $docx->cloneBlock('no_double', 0, true, true);
            $docx->cloneBlock('double', 1, true, true);
        } else {
            $docx->cloneBlock('no_double', 1, true, true);
            $docx->cloneBlock('double', 0, true, true);
        }


        $appendices_bot = GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoAppendicies($this->document->id);
        $append_i_bot = 1;
        $append_bot = array();
        foreach ($appendices_bot as $value) {
            $append_bot[] = array('append_id' => $append_i_bot, 'app' => $value);
            $append_i_bot++;
        }
        $docx->cloneBlock('appendices_bot', 0, true, false, $append);

        //GOOGLE API//


                $apiService = new ApiService($this->document);

                $coordinate = $apiService->getEnergySertificate();


        //PHOTO//


        $vanilArray = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        if (GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoImgs($this->document->id)) {
            $photoArr = array();
            foreach (GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoImgs($this->document->id) as $id => $value)
            {
                $photoArr[] = $value;
            }


            $fileNumber = 1;

            $fileNumberLeftSide = 0;
            $fileNumberRightSide = 0;
            $arrayOfDockNumbersLeft = array();
            $arrayOfDockNumbersRight = array();


            foreach ($photoArr as $photoObj) {
                if (!(($fileNumber % 2) === 0)) {
                    $docx->setValue("files_name_left_$fileNumberLeftSide", $photoObj->name);
                    $docx->setImageValue("files_path_left_$fileNumberLeftSide", [
                        'path'   => Url::to("@app/web/$photoObj->path"),
                        'width'  => '500',
                        'height' => '200',
                    ]);

                    $docx->cloneBlock("files_left_$fileNumberLeftSide", 1, true, false);
                    $arrayOfDockNumbersLeft[] = $fileNumberLeftSide;

                    $mayBeForNullImg = $fileNumberLeftSide;
                    ++$fileNumberLeftSide;
                } else {
                    $docx->setValue("files_name_right_$fileNumberRightSide", $photoObj->name);


                    $docx->setImageValue("files_path_right_$fileNumberRightSide", [
                        'path'   => Url::to("@app/web/$photoObj->path"),
                        'width'  => '500',
                        'height' => '200',
                    ]);

                    $arrayOfDockNumbersRight[] = $fileNumberRightSide;
                    ++$fileNumberRightSide;
                }

                ++$fileNumber;
            }
            $docx->setValue("files_name_right_$mayBeForNullImg", 'photo may be here');
            $docx->setValue("files_path_right_$mayBeForNullImg", '');

            $resultArrayLeft = array_diff($vanilArray, $arrayOfDockNumbersLeft);


            foreach ($resultArrayLeft as $number) {
                $docx->cloneBlock("files_left_$number", 0, true, true);
            }
            foreach ($vanilArray as $number) {
                $docx->cloneBlock("files_left_$number", 0, true, true);
            }
        } else {
            $docx->cloneBlock("files_left_0", 0, true, false);
            $docx->cloneBlock("files_left_1", 0, true, false);
            $docx->cloneBlock("files_left_2", 0, true, false);
            $docx->cloneBlock("files_left_3", 0, true, false);
            $docx->cloneBlock("files_left_4", 0, true, false);
            $docx->cloneBlock("files_left_5", 0, true, false);
            $docx->cloneBlock("files_left_6", 0, true, false);
            $docx->cloneBlock("files_left_7", 0, true, false);
            $docx->cloneBlock("files_left_8", 0, true, false);
            $docx->cloneBlock("files_left_9", 0, true, false);
        }


        $outputFille = 'review_full.docx';

        $docx->saveAs($outputFille);

        // файл, который нужно перенести
        $oldFilePath = Url::to('@app/web/review_full.docx');
// новый путь этого файла
        $newFilePath = Url::to("@app/web/uploadDocx/".$this->document->id."/review_full.docx");

// Получаем адрес директории нового пути
        $newFolderPath = pathinfo($newFilePath)["dirname"];

// смотрим, есть ли нужная новая директория или пытаемся её создать
        if (file_exists($newFolderPath) || mkdir($newFolderPath, 0777, true) || is_dir($newFolderPath)) {
            // перемещаем
            rename($oldFilePath, $newFilePath);
        }
        $newDocx = new Docx();
        $newDocx->path = "uploadDocx/".$this->document->id."/review_full.docx";
        $newDocx->save();
        $newDocumentDocx = new DocumentsDocx();
        $newDocumentDocx->documents_id = $this->document->id;
        $newDocumentDocx->docx_id = $newDocx->getId();
        $newDocumentDocx->save();
    }
}