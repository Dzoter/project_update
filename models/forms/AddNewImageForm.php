<?php

namespace app\models\forms;

use yii\base\Model;

class AddNewImageForm extends Model
{

    public $file_name;
    public $files;
    public $document_id;

    public function rules()
    {
        return [
            [['file_name','document_id'], 'safe', 'message' => 'поле должно быть заполнено'],
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