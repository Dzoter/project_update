<?php

namespace app\services\referenceTables;
use app\models\BasisOfValue;
use app\models\Documents;
use app\models\DocumentsBasisOfValue;
use app\models\forms\AddDocumentToBdForm;

class BasisOfValueService extends AbstractReferenceTable
{


    public function addBasisOfValue(AddDocumentToBdForm $addDocumentToBdForm)
    {
        if ($addDocumentToBdForm->basis_of_value_ids) {
            foreach ($addDocumentToBdForm->basis_of_value_ids as $key => $basisOfValueId) {
                $basisOfValue = new DocumentsBasisOfValue();
                $basisOfValue->documents_id = $this->document->id;
                $basisOfValue->basis_of_value_id = $basisOfValueId;
                $basisOfValue->save();
            }
        }
        if ($addDocumentToBdForm->basis_of_value_ids_right) {
            foreach ($addDocumentToBdForm->basis_of_value_ids_right as $key => $basisOfValueId) {
                $basisOfValue = new DocumentsBasisOfValue();

                $basisOfValue->documents_id = $this->document->id;
                $basisOfValue->basis_of_value_id = $basisOfValueId;
                $basisOfValue->save();
            }
        }
    }
    public static function deleteBasisOfValue(Documents $document)
    {
        $basisOfValues = DocumentsBasisOfValue::find()->where(['documents_id' => $document->id])->all();
        if ($basisOfValues) {
            foreach ($basisOfValues as $basisOfValue) {
                $basisOfValue->delete();
            }
        }
    }

}