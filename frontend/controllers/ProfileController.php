<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Model;
use common\models\ModelImage;
use common\models\PhotographerImage;
use common\models\InstagramImage;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;

set_time_limit(1000);

class ProfileController extends Controller
{

  public function behaviors()
  {
      return [
          'access' => [
              'class' => AccessControl::className(),
              'only' => ['index', 'edit'],
              'rules' => [
                  [
                      'actions' => ['index', 'edit', 'remove-image'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
              ],
              'denyCallback' => function ($rule, $action) {
                  throw new \Exception('У вас нет доступа к этой странице');
              }
          ],
      ];
  }

  public function actionIndex()
  {
    $user = Yii::$app->user->identity;
    $model = $user->entity;

    if (in_array($user->status, [User::STATUS_EMPTY_MODEL, User::STATUS_EMPTY_PHOTOGRAPHER, User::STATUS_EMPTY_COMPANY])) {
      return $this->redirect('/profile/edit');
    }


    if ($user->type == User::TYPE_MODEL) {

      return $this->redirect('/model/' . $model->id);

      return $this->render('//model/index', [
        'model' => $model,
        'isProfile' => true,
      ]);
    } else if ($user->type == User::TYPE_PHOTOGRAPHER) {


      return $this->redirect('/photographer/' . $model->id);

      return $this->render('//photographer/index', [
        'model' => $model,
        'isProfile' => true,
      ]);
    }
  }

  public function actionEdit()
  {
    $user = Yii::$app->user->identity;
    $model = $user->entity;



    if (Yii::$app->request->isPost) {

      $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
      $model->uploadAvatar();


      if ($user->type == User::TYPE_MODEL) {
        $model->digitFile_1 = UploadedFile::getInstance($model, 'digitFile_1');
        $model->digitFile_2 = UploadedFile::getInstance($model, 'digitFile_2');
        $model->digitFile_3 = UploadedFile::getInstance($model, 'digitFile_3');
        $model->digitFile_4 = UploadedFile::getInstance($model, 'digitFile_4');
        $model->uploadDigits();
      }
      // test($_POST);die;

      $new = false;

      $data = Yii::$app->request->post();
      if ($user->load($data)) {
        if ($user->status == User::STATUS_EMPTY_MODEL) {
          $user->status = User::STATUS_FILLED_MODEL;
          $new = true;
        } else if ($user->status == User::STATUS_EMPTY_PHOTOGRAPHER) {
          $user->status = User::STATUS_FILLED_PHOTOGRAPHER;
          $new = true;
        }
        $user->save();
      }

      if ($model->load($data) && $model->save()) {
        // test($user->name);die;
      }

      if (isset($data['connect-instagram'])) {
        return $this->redirect( Yii::$app->instagram->getLoginUrl() );
      }

      if (isset($_FILES['Model']['name']['images'])) {

        $dir = Yii::getAlias('@upload/') . $model->userId;
        if(!is_dir($dir)) { mkdir($dir, 0777, true); }


        $dir = Yii::getAlias('@upload/') . $model->userId . '/thumbnails';
        if(!is_dir($dir)) { mkdir($dir, 0777, true); }


        $imagesPath = Yii::getAlias('@upload/'  . $model->userId . '/');

        foreach ($_FILES['Model']['name']['images'] as $key => $imageName) {
          if($_FILES['Model']['error']['images'][ $key ] == 0) {
            $tmp = explode('.', $imageName);
            $fileName = Yii::$app->security->generateRandomString(12) . '.' . end($tmp);


            if(move_uploaded_file($_FILES['Model']['tmp_name']['images'][ $key ] , $imagesPath . $fileName)) {
              // Yii::$app->imageOptimizer->optimize($imagesPath . $fileName);
              Yii::$app->imageOptimizer->deleteEXIFMetadata($imagesPath . $fileName);


              if ($user->type == User::TYPE_MODEL) {
                $mi = new ModelImage();
                $mi->modelId = $model->id;
              } else if ($user->type == User::TYPE_PHOTOGRAPHER) {
                $mi = new PhotographerImage();
                $mi->photographerId = $model->id;
              }
              $mi->image = $fileName;
              $mi->save();

              if (Image::thumbnail($imagesPath . $fileName, 280, null, ManipulatorInterface::THUMBNAIL_OUTBOUND)->save(Yii::getAlias('@upload/') . $model->userId . '/thumbnails/' . $fileName, ['quality' => 81])) {
                  // Yii::$app->imageOptimizer->optimize($imagesPath . $fileName);
              }

            }
          }
        }
      }


      if ($new) {
        Yii::$app->mailer->compose('new-user', ['user' => $user])->setTo(
                ['mitrofanovich95@mail.ru', 'pavel@modelista.ru']
            )->setFrom([Yii::$app->params['supportEmail'] => 'modelista.ru'])->setSubject(
                'Modelista - новая пользователь!'
            )->send();
      }

      // test($_FILES);die;

      return $this->redirect('/profile/edit');
    }


    return $this->render('edit-' . User::typeSlug()[ $user->type ], [
      'user' => $user,
      'model' => $model,
    ]);
  }


  public function actionRemoveImage()
  {
    $user = Yii::$app->user->identity;
    $entity = $user->entity;

    if (isset($_GET['id']) AND $user->type == User::TYPE_MODEL) {
      $mi = ModelImage::find()
        ->where(['id' => $_GET['id']])
        ->andWhere(['modelId' => $entity->id])
      ->one();
      if(is_object($mi)) {
        $mi->delete();
        return true;
      }
    } else if (isset($_GET['type']) AND $user->type == User::TYPE_MODEL) {
      if ($_GET['type'] == 'digit_1') {
        $entity->digit_1 = '';
      } else if ($_GET['type'] == 'digit_2') {
        $entity->digit_2 = '';
      } else if ($_GET['type'] == 'digit_3') {
        $entity->digit_3 = '';
      } else if ($_GET['type'] == 'digit_4') {
        $entity->digit_4 = '';
      }
      if ($entity->save(false)) {
        return true;
      }
    } else if (isset($_GET['id']) AND $user->type == User::TYPE_PHOTOGRAPHER) {
      $mi = PhotographerImage::find()
        ->where(['id' => $_GET['id']])
        ->andWhere(['photographerId' => $entity->id])
      ->one();
      if(is_object($mi)) {
        $mi->delete();
        return true;
      }
    }
    return false;
  }

  public function actionChangeStatus()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $status = isset($_GET['status']) ? $_GET['status'] : false;
    if ($id !== false AND $status !== false) {
      $user = User::findOne($id);
      if (is_object($user)) {
        $user->status = $status;
        $user->save();

        if ($user->type == User::TYPE_MODEL) {
          return $this->redirect('/model/' . $user->entity->id .'?check');
        } else if ($user->type == User::TYPE_PHOTOGRAPHER) {
          return $this->redirect('/photographer/' . $user->entity->id .'?check');
        }

        // return 'Изменено!';
      }
    }
    return 'Ошибка!';
  }


  public function actionInstagram()
  {
    $user = Yii::$app->user->identity;
    $model = $user->entity;


    $profile = Yii::$app->instagram->getUserProfile();
    $images = Yii::$app->instagram->getUserMedia('me', 99);
    // test($images);die;
    // test($profile);die;


    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      $imgPath = Yii::getAlias('@upload/') . $user->id . '/instagram';
      if (!file_exists($imgPath)) mkdir($imgPath);


      $iImgs = InstagramImage::find()->where(['userId' => $user->id])->all();
      foreach ($iImgs as $key => $iImg) {
        $iImg->delete();
      }

      foreach ($images->data as $key => $image) {
        if (isset($data[ $image->id ])) {
          // test($image);

          $ext = explode('?', $image->media_url);
          $ext = explode('.', $ext[0]);
          $ext = $ext[ sizeof($ext) - 1 ];


          if (copy($image->media_url, $imgPath . '/' . $image->id . '.' . $ext)) {
              $instagramImage = new InstagramImage();
              $instagramImage->userId = $user->id;
              $instagramImage->instagramImageId = $image->id;
              $instagramImage->image = $image->id . '.' . $ext;
              $instagramImage->caption = $image->caption;
              $instagramImage->permalink = $image->permalink;
              $instagramImage->username = $image->username;
              $instagramImage->timestamp = $image->timestamp;
              $instagramImage->save();
          }


        }
      }
      // die;

      $this->redirect('/model/' . $model->id);

    }


    return $this->render('instagram', [
      'user' => $user,
      'model' => $model,
      'profile' => $profile,
      'images' => $images,
    ]);
  }
}
