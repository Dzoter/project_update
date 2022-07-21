<?php

namespace app\services\documents;

use app\models\forms\AddSectorInfoForm;
use app\models\SectorOverview;

class AddSectorInfoService
{
    public function addSector(AddSectorInfoForm $addSectorInfoForm)
    {
        $idOfSector = implode($addSectorInfoForm->sector_radio);
        $sector = SectorOverview::find()->where(['id'=>$idOfSector])->one();
        $sector->info = $addSectorInfoForm->sectorInfo;
        $sector->save();
    }

}