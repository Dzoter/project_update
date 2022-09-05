<?php

namespace app\services\referenceTables;

use app\models\Documents;
use app\models\DocumentsSectorOverview;
use app\models\forms\AddDocumentToBdForm;

class SectorOverviewService extends AbstractReferenceTable
{


    public function addSectorOverview(AddDocumentToBdForm $addDocumentToBdForm)
    {
        if ($addDocumentToBdForm->sector_overview_ids) {
            foreach ($addDocumentToBdForm->sector_overview_ids as $key => $sectorOverviewId) {
                $sectorOver = new DocumentsSectorOverview();
                $sectorOver->documents_id = $this->document->id;
                $sectorOver->sector_overview_id = $sectorOverviewId;
                $sectorOver->save();
            }
        }
        if ($addDocumentToBdForm->sector_overview_ids_right) {
            foreach ($addDocumentToBdForm->sector_overview_ids_right as $key => $sectorOverviewId) {
                $sectorOverRight = new DocumentsSectorOverview();
                $sectorOverRight->documents_id = $this->document->id;
                $sectorOverRight->sector_overview_id = $sectorOverviewId;
                $sectorOverRight->save();
            }
        }
    }
    public static function deleteSectorOverview(Documents $document)
    {
        $sectors = DocumentsSectorOverview::find()->where(['documents_id' => $document->id])->all();
        if ($sectors) {
            foreach ($sectors as $sector) {
                $sector->delete();
            }
        }
    }
}