<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;

class Model extends ActiveRecord
{
    public $avatarFile;
    public $digitFile_1;
    public $digitFile_2;
    public $digitFile_3;
    public $digitFile_4;

    public static function tableName()
    {
        return '{{%model}}';
    }

    public function rules()
    {
        return [
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['digitFile_1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['digitFile_2'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['digitFile_3'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['digitFile_4'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['avatar', 'city', 'instagram', 'phone', 'telegram', 'whatsapp', 'video', 'digit_1', 'digit_2', 'digit_3', 'digit_4'], 'string', 'max' => 255],
            [['pastClients'], 'string'],
            [[
              'userId',
              'categoryId',
              'gender',
              'hourPrice',
              'dayPrice',
              'age',
              'height',
              'weight',
              'shoes',
              'shirt',
              'bust',
              'ethnicity',
              'eyes',
              'hair',
              'tattoo',
              'isHiddenContacts',
              'tfp',
            ], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'Пользователь',
            'avatar' => 'Аватар',
            'categoryId' => 'Категория',
            'city' => 'Город',
            'gender' => 'Пол',
            'hourPrice' => 'Стоимость часа',
            'dayPrice' => 'Стоимость дня',
            'age' => 'Возраст',
            'height' => 'Рост',
            'weight' => 'Вес',
            'shoes' => 'Размер обуви',
            'shirt' => 'Размер одежды',
            'bust' => 'Размер груди',
            'ethnicity' => 'Тип лица',
            'eyes' => 'Цвет глаз',
            'hair' => 'Цвет волос',
            'tattoo' => 'Татуировки',
            'instagram' => 'Инстаграм',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'whatsapp' => 'Whatsapp',
            'video' => 'Промо видео',
            'pastClients' => 'Последние места работы',
            'isHiddenContacts' => 'Скрыть ваши контакты?',
            'tfp' => 'Возможно ли TFP?',
        ];
    }


    private function checkDir($path = false)
    {
      $dir = Yii::getAlias('@upload/') . $this->userId;

      if ($path) {
        $dir .= '/' . $path;
      }

      if(!is_dir($dir)) {
        mkdir($dir, 0777, true);
      }
    }


    public function uploadAvatar()
    {
      if (is_object($this->avatarFile)) {
        $fileName = Yii::$app->security->generateRandomString(12) . '.' . $this->avatarFile->extension;

        $this->avatar = $fileName;

        $path = '@upload/';
        $imagePath = Yii::getAlias($path . 'all/' . $fileName);

        if ($this->avatarFile->saveAs($imagePath)) {
            // Yii::$app->imageOptimizer->optimize($imagePath);
            Yii::$app->imageOptimizer->deleteEXIFMetadata($imagePath);
        }

        $avatarPath = Yii::getAlias($path . 'avatars/' . $fileName); // 342x204

        if (Image::thumbnail($imagePath, 180, 180, ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($avatarPath, ['quality' => 81])) {
            // Yii::$app->imageOptimizer->optimize($avatarPath);
        }

        return true;
      } else {
        return false;
      }
    }

    public function uploadDigits()
    {
      $digitFiles = [
        $this->digitFile_1,
        $this->digitFile_2,
        $this->digitFile_3,
        $this->digitFile_4,
      ];


      $this->checkDir();
      $this->checkDir('digits');

      if (is_array($digitFiles)) {
        foreach ($digitFiles as $key => $digitFile) {
          if (is_object($digitFile)) {
            $fileName = Yii::$app->security->generateRandomString(12) . '.' . $digitFile->extension;

            if ($key == 0) { $this->digit_1 = $fileName; }
            else if ($key == 1) { $this->digit_2 = $fileName; }
            else if ($key == 2) { $this->digit_3 = $fileName; }
            else if ($key == 3) { $this->digit_4 = $fileName; }

            $path = '@upload/' . $this->userId;
            $imagePath = Yii::getAlias($path . '/digits/' . $fileName);

            if ($digitFile->saveAs($imagePath)) {
                // Yii::$app->imageOptimizer->optimize($imagePath);
                Yii::$app->imageOptimizer->deleteEXIFMetadata($imagePath);
            }

          }
        }



        return true;
      } else {
        return false;
      }
    }

    public function getAvatarImage()
    {
      if(!is_null($this->avatar) AND !empty($this->avatar)) {
        return Yii::getAlias('/upload/avatars/' . $this->avatar);;
      }
      return '/img/placeholder@2x.png';
    }

    public function getDigit1Image()
    {
      if(!is_null($this->digit_1) AND !empty($this->digit_1)) {
        return Yii::getAlias('/upload/'.$this->userId.'/digits/' . $this->digit_1);;
      }
      return '/img/digit_1.jpg';
    }
    public function getDigit2Image()
    {
      if(!is_null($this->digit_2) AND !empty($this->digit_2)) {
        return Yii::getAlias('/upload/'.$this->userId.'/digits/' . $this->digit_2);;
      }
      return '/img/digit_2.jpg';
    }
    public function getDigit3Image()
    {
      if(!is_null($this->digit_3) AND !empty($this->digit_3)) {
        return Yii::getAlias('/upload/'.$this->userId.'/digits/' . $this->digit_3);;
      }
      return '/img/digit_3.jpg';
    }
    public function getDigit4Image()
    {
      if(!is_null($this->digit_4) AND !empty($this->digit_4)) {
        return Yii::getAlias('/upload/'.$this->userId.'/digits/' . $this->digit_4);;
      }
      return '/img/digit_4.jpg';
    }

    public function getImages()
    {
        return $this->hasMany(ModelImage::className(), ['modelId' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getInstagramImages()
    {
        return $this->hasMany(InstagramImage::className(), ['userId' => 'userId']);
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
