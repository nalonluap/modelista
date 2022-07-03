<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;


class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $email;
    public $password;
    public $type;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'trim'],
            [['name', 'surname'], 'required', 'message' => 'Это поле не может быть пустым!'],
            [['type'], 'integer'],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Это поле не может быть пустым!'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email адрес уже занят!'],

            ['password', 'required', 'message'=>'Это поле не может быть пустым!'],
            ['password', 'string', 'min' => 4, 'message' => 'Пароль должен содержать не меньше четырех символов!'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->type = $this->type;
        $user->email = $this->email;



        if ($user->type == User::TYPE_MODEL) {
          $user->status = User::STATUS_EMPTY_MODEL;
        } else if ($user->type == User::TYPE_PHOTOGRAPHER) {
          $user->status = User::STATUS_EMPTY_PHOTOGRAPHER;
        } else if ($user->type == User::TYPE_COMPANY) {
          $user->status = User::STATUS_EMPTY_COMPANY;
        }

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {

      // Yii::$app->mailer->compose()->setTo(
      //         'mitrofanovich95@mail.ru'
      //     )->setFrom([Yii::$app->params['supportEmail'] => 'modelista.ru'])->setSubject(
      //         'Modelista - новый пользователь!'
      //     )->send();

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
            'password' => 'Пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'type' => 'Тип',
         ];
    }
}
