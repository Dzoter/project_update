<?php

namespace app\services\documents;

use app\models\DocumentsFiles;
use app\models\Files;
use app\models\forms\AddAnotherImgForm;
use app\models\forms\AddNewImageForm;
use app\models\forms\RefactorImgForm;
use yii\helpers\Url;
use yii\web\UploadedFile;

class ImgService
{
    public function deleteImg($imgId)
    {
        $img = Files::find()->where(['id' => $imgId])->one();
        $imgPath = $img->path;
        $documentImg = DocumentsFiles::find()->where(['files_id' => $imgId])->one();
        $documentImg->delete();
        $img->delete();

        return unlink(Url::to("@app/web/$imgPath"));
    }

    public function refactorImg(RefactorImgForm $renameImgForm)
    {
        $img = Files::find()->where(['id' => $renameImgForm->id])->one();

        $img->name = $renameImgForm->new_name;
        $img->save();
    }

    public function addAnotherImg(AddAnotherImgForm $addAnotherImgForm)
    {
        $oldImg = Files::find()->where(['id' => $addAnotherImgForm->id_image])->one();
        $oldPath = $oldImg->path;
        $documentsFile = DocumentsFiles::find()->where(['files_id' => $oldImg->id])->one();


        $path = "uploadedImg/"."$documentsFile->documents_id/";
        $fileIteration = 0;


        $addAnotherImgForm->files = UploadedFile::getInstances($addAnotherImgForm, 'files');


        if ($addAnotherImgForm->files) {
            foreach ($addAnotherImgForm->files as $file) {
                if ($addAnotherImgForm->file_name[$fileIteration]) {
                    $ImgFileName = $addAnotherImgForm->file_name.'.'.$file->extension;

                    ++$fileIteration;
                } else {
                    $ImgFileName = $file->name.'.'.$file->extension;
                }

                $file->saveAs(
                    $path.$ImgFileName
                );

                $oldImg->path = (string)$path.(string)$ImgFileName;
                $oldImg->name = (string)$ImgFileName;
                $oldImg->save();

                return unlink(Url::to("@app/web/$oldPath"));
            }
        }
    }

    public function addNewImg(AddNewImageForm $addNewImageForm)
    {
        $addNewImageForm->files = UploadedFile::getInstances($addNewImageForm, 'files');


        $path = "uploadedImg/"."$addNewImageForm->document_id/";
        if ($addNewImageForm->files) {

            foreach ($addNewImageForm->files as $file) {
                if ($addNewImageForm->file_name[$fileIteration]) {
                    $ImgFileName = $addNewImageForm->file_name.'.'.$file->extension;

                    ++$fileIteration;
                } else {
                    $ImgFileName = $file->name.'.'.$file->extension;
                }

                $file->saveAs(
                    $path.$ImgFileName
                );
                $newImg = new Files();
                $newImg->path = (string)$path.(string)$ImgFileName;
                $newImg->name = (string)$ImgFileName;
                $newImg->save();
                $documentFiles = new DocumentsFiles();
                $documentFiles->files_id = $newImg->getId();
                $documentFiles->documents_id = $addNewImageForm->document_id;
                $documentFiles->save();
            }

        }
    }
}