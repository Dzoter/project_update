<?php

namespace app\models\forms;

use yii\base\Model;

class RefactorImgForm extends Model
{
    public $new_name;
    public $id;


    public function rules()
    {
        return [
            [['new_name', 'id',], 'safe', 'message' => 'поле должно быть заполнено'],

        ];
    }
}