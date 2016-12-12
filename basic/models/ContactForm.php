<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'email', 'subject', 'body'], 'safe'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function myValidation($attribute){

        if(!in_array($this->$attribute, [1,2,3,4])){

            $this->addError($attribute, 'Не входит и не выходит');

        }

    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [

            'name' => 'Ваше имя:',
            'subject' => 'Тема:',
            'body' => 'Текст обращения:',
            'verifyCode' => 'Введите, плз, символы с картинки еще, а то мало ли..'

        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
