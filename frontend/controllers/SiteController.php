<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\ImageOptimize;
use common\models\ImageCompress;

class SiteController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionLoadAllImages()
    {
      $optimizer = new ImageOptimize();
      $files = $optimizer->getAllFiles();
      foreach ($files as $key => $file) {


        $file = str_replace('/var/www/u208993/data/www/', 'https://', $file);
        $file = str_replace('/frontend/web/', '/', $file);

        $check = $files = ImageCompress::find()->where(['done' => true])->andWhere(['imgPath' => $file])->one();
        if (!is_object($check)) {
          $ic = new ImageCompress();
          $ic->imgPath = $file;
          $ic->save();
        }

      }
    }



    public function actionCompress()
    {
        $optimizer = new ImageOptimize();
        $files = ImageCompress::find()->where(['done' => false])->limit(200)->all();

        foreach ($files as $key => $file) {
          $imgPath = $file->imgPath;
          $res = $optimizer->optimize($imgPath);

          // test($res);die;

          if (!empty($res['error'])) {
            $file->error = $res['error'];
          } elseif (!empty($res['output']['url'])) {


            $imgPath = str_replace('https://modelista.ru/upload', '', $imgPath);

            $imgPath = Yii::getAlias('@upload' . $imgPath);
            if (rename($imgPath, $imgPath . '.bak')) {
          		if (copy($res['output']['url'], $imgPath)) {
          			$diff = $res['input']['size'] - $res['output']['size'];
          		} else {
          			rename($imgPath . '.bak', $imgPath);
          		}
          	}


            $file->done = true;
            $file->inputSize = (string)$res['input']['size'];
            $file->outputSize = (string)$res['output']['size'];
            $file->diff = (string)(intval($res['input']['size']) - intval($res['output']['size']));
            $file->outputUrl = $res['output']['url'];
          }
          $file->save();


        }

    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
