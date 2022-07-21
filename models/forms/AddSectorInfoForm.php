<?php

namespace app\models\forms;

use yii\base\Model;

class AddSectorInfoForm extends Model
{
    public $sectorInfo;
    public $sector_radio;


    public function rules(){
        return [
          [['sectorInfo'],'required','message' => 'area cannot be blank'],
            [['sector_radio'],'safe']

        ];
    }

}