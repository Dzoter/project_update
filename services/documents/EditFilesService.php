<?php

namespace app\services\documents;

use app\models\DocumentsFiles;
use app\models\DocumentsPdf;
use app\models\Files;
use app\models\forms\AddAnotherImgForm;
use app\models\forms\AddNewImageForm;
use app\models\forms\RefactorImgForm;
use app\models\Pdf;
use app\services\referenceTables\FilesService;
use yii\helpers\Url;
use yii\web\UploadedFile;

class EditFilesService extends FilesService
{
    public function editDeleteImgById($imgId)
    {
        $img = Files::find()->where(['id' => $imgId])->one();
        $imgPath = $img->path;
        $documentImg = DocumentsFiles::find()->where(['files_id' => $imgId])->one();
        $documentImg->delete();
        $img->delete();

        return unlink(Url::to("@app/web/$imgPath"));
    }
    public function editDeletePdfById($pdfId)
    {
        $pdf = Pdf::find()->where(['id'=>$pdfId])->one();
        $pdfPath = $pdf->path;
        $documentPdf = DocumentsPdf::find()->where(['pdf_id' => $pdfId])->one();
        $documentPdf->delete();
        $pdf->delete();
        return unlink(Url::to("@app/web/$pdfPath"));

    }

    public function editRefactorImgById(RefactorImgForm $renameImgForm)
    {
        $img = Files::find()->where(['id' => $renameImgForm->id])->one();

        $img->name = $renameImgForm->new_name;
        $img->save();
    }

    public function editAnotherImg(AddAnotherImgForm $addAnotherImgForm)
    {

        $oldImg = Files::find()->where(['id' => $addAnotherImgForm->id_image])->one();
        $oldPath = $oldImg->path;
        $documentsFile = DocumentsFiles::find()->where(['files_id' => $oldImg->id])->one();


        $path = "uploadedImg/"."$documentsFile->documents_id/";


        $addAnotherImgForm->files = UploadedFile::getInstances($addAnotherImgForm, 'files');


        if ($addAnotherImgForm->files) {

            $ImgFileName =$addAnotherImgForm->file_name.'.'.$addAnotherImgForm->files[0]->extension;


            $addAnotherImgForm->files[0]->saveAs(
                    $path.$ImgFileName
                );

                $oldImg->path = (string)$path.(string)$ImgFileName;
                $oldImg->name = (string)$ImgFileName;
                $oldImg->save();

                return unlink(Url::to("@app/web/$oldPath"));
            }

        return false;

    }

    public function editAddNewFile(AddNewImageForm $addNewImageForm)
    {
        $addNewImageForm->files = UploadedFile::getInstances($addNewImageForm, 'files');


        foreach ($addNewImageForm->files as $file){

            $fileName = $addNewImageForm->file_name;
            if ($file->type === 'image/jpeg' || $file->type === 'image/png'){
                $this->addImg($file,$fileName);
            } elseif ($file->type === 'application/pdf'){
                $this->addPdf($file,$fileName);
            }

            $this->convertPdfToImg();
        }

    }
}