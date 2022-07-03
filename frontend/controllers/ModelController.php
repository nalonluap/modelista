<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\User;
use common\models\Model;
use common\models\Photographer;
use common\models\ModelImage;
use common\models\ContactRequest;
use common\models\Notification;


class ModelController extends Controller
{

    public function actionIndex($id)
    {
      $check = isset($_GET['check']) ? true : false;

      if (!Yii::$app->user->isGuest) {
        if ($id == Yii::$app->user->identity->entity->id AND Yii::$app->user->identity->type == User::TYPE_MODEL) {
          $user = Yii::$app->user->identity;
          $model = $user->entity;

          if (in_array($user->status, [User::STATUS_EMPTY_MODEL, User::STATUS_EMPTY_PHOTOGRAPHER, User::STATUS_EMPTY_COMPANY])) {
            return $this->redirect('/profile/edit');
          }

          if ($user->type == User::TYPE_MODEL) {
            return $this->render('//model/index', [
              'model' => $model,
              'isProfile' => true,
            ]);
          } else if ($user->type == User::TYPE_PHOTOGRAPHER) {
            return $this->render('//photographer/index', [
              'model' => $model,
              'isProfile' => true,
            ]);
          }

        }
      }



      $model = Model::find()
        ->where(['model.id' => $id])
        ->leftJoin('user', 'user.id = model.userId');
      if (!$check) {
        $model = $model->andWhere(['user.status' => User::STATUS_ACTIVE]);
      }
      $model = $model->one();

      if (!is_object($model)) {
        throw new \yii\web\NotFoundHttpException;
      }

      return $this->render('index', [
        'model' => $model,
        'check' => $check,
      ]);
    }

    public function actionGetContacts()
    {
      Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

      if (isset($_GET['id']) AND isset($_GET['type'])) {
        $user = Yii::$app->user->identity;

        if ($_GET['type'] == User::TYPE_MODEL) {
          $model = Model::find()->where(['id' => $_GET['id']])->one();
        } else if ($_GET['type'] == User::TYPE_PHOTOGRAPHER) {
          $model = Photographer::find()->where(['id' => $_GET['id']])->one();
        }

        if (is_object($model) AND $model->userId != $user->id) {

          $checkRequest = false;
          $req = ContactRequest::find()
            ->where(['senderUserId' => $user->id])
            ->andWhere(['recipientUserId' => $model->userId])
            ->andWhere(['status' => ContactRequest::STATUS_ACCEPTED])
          ->one();
          if (is_object($req)) {
            $checkRequest = true;
          }

          return ['status' => true, 'render' => $this->renderPartial('_contact-data', [
            'user' => $user,
            'model' => $model,
            'checkRequest' => $checkRequest,
          ])];
        }

      }
      return ['status' => false];
    }


    public function actionSendRequest()
    {
      Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

      if (isset($_GET['id'])) {
        $user = Yii::$app->user->identity;
        $model = User::find()->where(['id' => $_GET['id']])->one();

        if (is_object($model) AND $model->id != $user->id) {

          $req = ContactRequest::find()
            ->where(['senderUserId' => $user->id])
            ->andWhere(['recipientUserId' => $model->id])
            ->andWhere(['!=', 'status', ContactRequest::STATUS_DENIED])
          ->one();
          if(!is_object($req)) {
            $request = new ContactRequest();
            $request->senderUserId = $user->id;
            $request->recipientUserId = $model->id;
            if ($request->save()) {

              $notification = new Notification();
              $notification->senderUserId = $user->id;
              $notification->recipientUserId = $model->id;
              $notification->type = Notification::TYPE_CONTACT_REQUEST;
              $notification->save();


              Yii::$app->mailer->compose('new-contact-request', ['sender' => $user])->setTo(
                      $model->email
                  )->setFrom([Yii::$app->params['supportEmail'] => 'modelista.ru'])->setSubject(
                      'Новый запрос на контакты!'
                  )->send();


              return ['status' => true, 'render' => $this->renderPartial('_success-send-request', [
                'user' => $user,
                'model' => $model,
              ])];
            }
          } else {
            return ['status' => false, 'msg' => 'Вы уже отправили запрос этому профилю. Дождитесь ответа!'];
          }

        }

      }
      return ['status' => false, 'msg' => 'Что-то пошло не так... Свяжитесь с администрацией сайта'];
    }




    public function actionSetNotification()
    {
      Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

      if (isset($_GET['id']) AND isset($_GET['type'])) {
        $user = Yii::$app->user->identity;
        $notification = Notification::find()->where(['id' => $_GET['id']])->one();


        if (is_object($notification)) {

          $req = $notification->contactRequest;
          if(is_object($req)) {

            if ($_GET['type'] == 'accept') {
              $req->status = ContactRequest::STATUS_ACCEPTED;
            } else if ($_GET['type'] == 'deny') {
              $req->status = ContactRequest::STATUS_DENIED;
            }

            if ($req->save()) {


              $notifi = new Notification();
              $notifi->senderUserId = $notification->recipientUserId;
              $notifi->recipientUserId = $notification->senderUserId;
              if ($_GET['type'] == 'accept') {
                $notifi->type = Notification::TYPE_ACCEPTED_CONTACT_REQUEST;
              } else if ($_GET['type'] == 'deny') {
                $notifi->type = Notification::TYPE_DENIED_CONTACT_REQUEST;
              }

              $notifi->save();


              Yii::$app->mailer->compose('contact-request-answer', ['sender' => $user, 'type' => $_GET['type']])->setTo(
                      $notifi->recipient->email
                  )->setFrom([Yii::$app->params['supportEmail'] => 'modelista.ru'])->setSubject(
                      'Ответ на запрос контактов!'
                  )->send();


              return ['status' => true];
            }
          } else {
            return ['status' => true];
            // return ['status' => false, 'msg' => 'Вы уже отправили запрос этому профилю. Дождитесь ответа!'];
          }

        }

      }
      return ['status' => false, 'msg' => 'Что-то пошло не так... Свяжитесь с администрацией сайта'];
    }

}
