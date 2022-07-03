<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\models\Model;
use common\models\Photographer;
use common\models\Favorite;


class FavoriteController extends Controller
{

    public function actionIndex()
    {
      $user = Yii::$app->user->identity;

      $models = [];
      $data = Favorite::find()->where(['userId' => $user->id])->all();

      foreach ($data as $fav) {
        $models[ $fav->type ][] = $fav;
      }


      return $this->render('index', [
        'models' => $models,
      ]);
    }

    public function actionAdd()
    {

      if (Yii::$app->user->isGuest) {
        return 3;
      }

      $user = Yii::$app->user->identity;
      if (isset($_GET['id']) AND isset($_GET['type'])) {
        $favorite = Favorite::find()
          ->where(['userId' => $user->id])
          ->andWhere(['entityId' => $_GET['id']])
          ->andWhere(['type' => $_GET['type']])
        ->one();
        if (is_object($favorite)) {
          if ($favorite->delete()) {
            return true;
          }
        } else {
          $favorite = new Favorite();
          $favorite->userId = $user->id;
          $favorite->entityId = $_GET['id'];
          $favorite->type = $_GET['type'];
          if ($favorite->save()) {
            return true;
          }
        }
      }
      return false;
    }

}
