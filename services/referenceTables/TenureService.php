<?php

namespace app\services\referenceTables;

use app\models\Documents;
use app\models\DocumentsTenure;
use app\models\forms\AddDocumentToBdForm;

class TenureService extends AbstractReferenceTable
{
    public function addTenure(AddDocumentToBdForm $addDocumentToBdForm)
    {
        $tenure = new DocumentsTenure();
        $tenure->documents_id = $this->document->id;
        $tenure->tenure_id = $addDocumentToBdForm->tenure_ids;
        $tenure->save();
    }
    public static function deleteTenure(Documents $document)
    {
        $tenures = DocumentsTenure::find()->where(['documents_id' => $document->id])->all();
        if ($tenures) {
            foreach ($tenures as $tenure) {
                $tenure->delete();
            }
        }
    }
}