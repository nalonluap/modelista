<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;


class RegisterCompanyForm extends Model
{
    public $email;
    public $text;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Это поле не может быть пустым!'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email адрес уже занят!'],

            ['text', 'required', 'message'=>'Это поле не может быть пустым!'],
            ['text', 'string'],
        ];
    }



    public function sendEmail()
    {

      Yii::$app->mailer->compose('company-register', ['email' => $this->email, 'text' => $this->text])->setTo(
              'mitrofanovich95@mail.ru'
          )->setFrom([Yii::$app->params['supportEmail'] => 'modelista.ru'])->setSubject(
              'Modelista - новый коммерческий запрос!'
          )->send();

        return true;
        // return Yii::$app
        //     ->mailer
        //     ->compose(
        //         ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
        //         ['user' => $user]
        //     )
        //     ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        //     ->setTo($this->email)
        //     ->setSubject('Account registration at ' . Yii::$app->name)
        //     ->send();
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'text' => 'Сообщение',
         ];
    }
}
