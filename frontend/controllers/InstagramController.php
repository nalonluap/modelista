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
use common\models\InstagramToken;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use common\components\Instagram;

class InstagramController extends Controller
{

  public function actionIndex()
  {
    echo "<a href='".Yii::$app->instagram->getLoginUrl()."'>Login with Instagram</a>";
  }


  public function actionToken()
  {
    if (!Yii::$app->user->isGuest) {
      $code = $_GET['code'] ?? false;
      if ($code AND !empty($code)) {
        $userId = Yii::$app->user->identity->id;

        $token = Yii::$app->instagram->getOAuthToken($code, true);
        $token = Yii::$app->instagram->getLongLivedToken($token, true);


        $instagramToken = InstagramToken::find()->where(['userId' => $userId])->one();
        if (!is_object($instagramToken)) {
          $instagramToken = new InstagramToken();
          $instagramToken->userId = $userId;
        }

        $instagramToken->token = $token;
        $instagramToken->save();

        return $this->redirect(['/profile/instagram']);
      }
    }
    throw new \yii\web\NotFoundHttpException;
  }
}
