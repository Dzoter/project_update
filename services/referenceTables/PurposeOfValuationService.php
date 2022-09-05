<?php

namespace app\services\referenceTables;

use app\models\Documents;
use app\models\DocumentsPurposeOfValuation;
use app\models\forms\AddDocumentToBdForm;

class PurposeOfValuationService extends AbstractReferenceTable
{

    public function addPurposeOfValuation(AddDocumentToBdForm $addDocumentToBdForm)
    {
        $purpur = new DocumentsPurposeOfValuation();
        $purpur->documents_id = $this->document->id;
        $purpur->purpose_of_valuation_id = $addDocumentToBdForm->purpose_of_Valuation_ids;
        $purpur->save();
    }
    public static function deletePurposeOfValution(Documents $document)
    {
        $purposes = DocumentsPurposeOfValuation::find()->where(['documents_id' => $document->id])->all();

        if ($purposes) {
            foreach ($purposes as $purpose) {
                $purpose->delete();
            }
        }
    }
}