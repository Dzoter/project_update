<?php

namespace app\services\documents;

use app\models\forms\AddSectorInfoForm;
use app\models\SectorOverview;

class AddSectorInfoService
{
    public function addSector(AddSectorInfoForm $addSectorInfoForm)
    {
        foreach ($addSectorInfoForm as $obj => $item) {
            var_dump($obj);
            if ($obj === 'sectorInfoCommercial') {
                $sector1 = SectorOverview::find()->where(['name' => 'Commercial'])->one();
                $sector1->info = $item;
                $sector1->save();
            }
            if ($obj === 'sectorInfoResidential') {
                $sector2 = SectorOverview::find()->where(['name' => 'Residential'])->one();
                $sector2->info = $item;
                $sector2->save();
            }
            if ($obj === 'sectorInfoHotels') {
                $sector3 = SectorOverview::find()->where(['name' => 'Hotels'])->one();
                $sector3->info = $item;
                $sector3->save();
            }
            if ($obj === 'sectorInfoDental') {
                $sector4 = SectorOverview::find()->where(['name' => 'Dental'])->one();
                $sector4->info = $item;
                $sector4->save();
            }
            if ($obj === 'sectorInfoCareHomes') {
                $sector5 = SectorOverview::find()->where(['name' => 'Care Homes'])->one();
                $sector5->info = $item;
                $sector5->save();
            }
            if ($obj === 'sectorInfoNurseries') {
                $sector6 = SectorOverview::find()->where(['name' => 'Nurseries'])->one();
                $sector6->info = $item;
                $sector6->save();
            }
        }
    }

}