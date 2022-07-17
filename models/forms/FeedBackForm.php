<?php
namespace app\models\forms;
use yii\base\Model;

class FeedBackForm extends Model
{
    public $name;
    public $email;
    public $message;

    public function rules()
    {
        return [
            [['name', 'email','message'], 'required', 'message' => 'поле должно быть заполнено'],
            [['name','message','email'],'contactValidate'],
            [['email'],'email','message' => 'Почта не валидна']
        ];
    }


    public function contactValidate() {
        $nameLen = iconv_strlen($this->name);
        $textLen = iconv_strlen($this->message);
        if ($nameLen < 3 || $nameLen > 20) {
            $errorMsg = 'Имя должно содержать от 3 до 20 символов';
            $this->addError('name',$errorMsg);
        } elseif ($textLen < 10 or $textLen > 500) {
            $errorMsg = 'Сообщение должно содержать от 10 до 500 символов';
            $this->addError('message',$errorMsg);

        }
    }
}