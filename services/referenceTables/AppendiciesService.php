<?php

namespace app\services\referenceTables;

use app\models\Documents;
use app\models\DocumentsAppendicies;
use app\models\forms\AddDocumentToBdForm;

class AppendiciesService extends AbstractReferenceTable
{


    public function addAppendicies(AddDocumentToBdForm $addDocumentToBdForm)
    {
        if ($addDocumentToBdForm->appendicies_ids) {
            foreach ($addDocumentToBdForm->appendicies_ids as $key => $appendiciesId) {
                $appen = new DocumentsAppendicies();
                $appen->documents_id = $this->document->id;
                $appen->appendicies_id = $appendiciesId;
                $appen->save();
            }
        }
        if ($addDocumentToBdForm->appendicies_ids_right) {
            foreach ($addDocumentToBdForm->appendicies_ids_right as $key => $appendiciesId) {
                $appenRight = new DocumentsAppendicies();
                $appenRight->documents_id = $this->document->id;
                $appenRight->appendicies_id = $appendiciesId;
                $appenRight->save();
            }
        }
    }
    public static function deleteAppendicies(Documents $document)
    {
        $appendicieses = DocumentsAppendicies::find()->where(['documents_id' => $document->id])->all();
        if ($appendicieses) {
            foreach ($appendicieses as $appendiciese) {
                $appendiciese->delete();
            }
        }
    }
}