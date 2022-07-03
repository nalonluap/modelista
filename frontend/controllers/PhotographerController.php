<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\User;
use common\models\Photographer;
use common\models\PhotographerImage;


class PhotographerController extends Controller
{

    public function actionIndex($id)
    {

      if (!Yii::$app->user->isGuest) {
        if ($id == Yii::$app->user->identity->entity->id AND Yii::$app->user->identity->type == User::TYPE_PHOTOGRAPHER) {
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


      $user = Yii::$app->user->identity;

      $model = Photographer::find()
        ->where(['photographer.id' => $id])
        ->leftJoin('user', 'user.id = photographer.userId');
      if (!isset($_GET['check'])) {
        $model = $model->andWhere(['user.status' => User::STATUS_ACTIVE]);
      }
      $model = $model->one();


      if (!is_object($model)) {
        throw new \yii\web\NotFoundHttpException;
      }

      return $this->render('index', [
        'model' => $model,
      ]);
    }


}
