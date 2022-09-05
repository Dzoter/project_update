<?php

namespace app\services\referenceTables;

use app\models\Documents;
use app\models\DocumentsMethodology;
use app\models\forms\AddDocumentToBdForm;

class MethodologyService extends AbstractReferenceTable
{


    public function addMethodology(AddDocumentToBdForm $addDocumentToBdForm)
    {
        if ($addDocumentToBdForm->methodology_ids) {
            foreach ($addDocumentToBdForm->methodology_ids as $key => $methodologyId) {
                $methodology = new DocumentsMethodology();
                $methodology->documents_id = $this->document->id;
                $methodology->methodology_id = $methodologyId;
                $methodology->save();
            }
        }
        if ($addDocumentToBdForm->methodology_ids_right) {
            foreach ($addDocumentToBdForm->methodology_ids_right as $key => $methodologyId) {
                $methodologyRight = new DocumentsMethodology();
                $methodologyRight->documents_id = $this->document->id;
                $methodologyRight->methodology_id = $methodologyId;
                $methodologyRight->save();
            }
        }
    }
    public static function deleteMethodology(Documents $document)
    {
        $methodologies = DocumentsMethodology::find()->where(['documents_id' => $document->id])->all();
        if ($methodologies) {
            foreach ($methodologies as $methodology) {
                $methodology->delete();
            }
        }
    }
}