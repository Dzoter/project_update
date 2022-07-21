<?php

namespace app\models\forms;

use yii\base\Model;

class AddAnotherImgForm extends Model
{
    public $id_image;
    public $file_name;
    public $files;

    public function rules()
    {
        return [
            [['file_name', 'id_image'], 'safe', 'message' => 'поле должно быть заполнено'],
            [
                ['files'],
                'file',
                'maxSize'  => 1024 * 1024 * 0.5,
                'maxFiles' => 20,
                'tooBig'   => 'файл слишком большой',
            ],
        ];
    }
}