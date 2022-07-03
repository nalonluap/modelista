<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\RegisterForm;
use frontend\models\RegisterCompanyForm;
use common\models\User;
use common\models\Model;
use common\models\Photographer;


class AuthController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'register', 'register-company', 'check'],
                'rules' => [
                    [
                        'actions' => ['register', 'register-company'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'check'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
      if (!Yii::$app->user->isGuest) {
          return $this->goHome();
      }

      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {
          return $this->redirect('/profile');
      } else {
          $model->password = '';

          return $this->render('login', [
              'model' => $model,
          ]);
      }
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/']);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            // Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');

            $user = User::findByEmail($model->email);
            if (is_object($user) AND Yii::$app->user->login($user, 3600 * 24 * 30)) {


              if ($user->type == User::TYPE_MODEL) {
                $model = new Model();
                $model->userId = $user->id;
                $model->save();
              } else if ($user->type == User::TYPE_PHOTOGRAPHER) {
                $model = new Photographer();
                $model->userId = $user->id;
                $model->save();
              } else if ($user->type == User::TYPE_COMPANY) {
              }

              return $this->redirect('/profile');
            }

        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionRegisterCompany()
    {
      $isSend = false;
      $model = new RegisterCompanyForm();
      if ($model->load(Yii::$app->request->post())) {
        $model->sendEmail();
        $isSend = true;
      }
      return $this->render('register-company', [
        'model' => $model,
        'isSend' => $isSend,
      ]);
    }

    public function actionCheck()
    {
      $user = Yii::$app->user->identity;

      if (in_array($user->status, [User::STATUS_EMPTY_MODEL, User::STATUS_EMPTY_PHOTOGRAPHER, User::STATUS_EMPTY_COMPANY])) {
        return $this->redirect('/profile/edit');
      }
      return $this->redirect('/profile');
    }

}
