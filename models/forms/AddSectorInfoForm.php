<?php

namespace app\models\forms;

use yii\base\Model;

class AddSectorInfoForm extends Model
{
    public $sectorInfoCommercial;
    public $sectorInfoResidential;
    public $sectorInfoHotels;
    public $sectorInfoDental;
    public $sectorInfoCareHomes;
    public $sectorInfoNurseries;




    public function rules(){
        return [
          [['sectorInfoCommercial','sectorInfoResidential','sectorInfoHotels','sectorInfoDental','sectorInfoCareHomes','sectorInfoNurseries'],'required','message' => 'area cannot be blank'],


        ];
    }

}