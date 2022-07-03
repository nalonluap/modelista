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

class Photographer extends ActiveRecord
{
    public $avatarFile;

    public static function tableName()
    {
        return '{{%photographer}}';
    }

    public function rules()
    {
        return [
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['avatar', 'city', 'instagram', 'phone', 'telegram', 'whatsapp', 'video'], 'string', 'max' => 255],
            [['pastClients'], 'string'],
            [[
              'userId',
              'categoryId',
              'gender',
              'hourPrice',
              'dayPrice',
              'age',
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
            'instagram' => 'Инстаграм',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'whatsapp' => 'Whatsapp',
            'video' => 'Промо видео',
            'pastClients' => 'Последние клиенты',
            'isHiddenContacts' => 'Скрыть ваши контакты?',
            'tfp' => 'Возможно ли TFP?',
        ];
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


    public function getAvatarImage()
    {
      if(!is_null($this->avatar) AND !empty($this->avatar)) {
        return Yii::getAlias('/upload/avatars/' . $this->avatar);;
      }
      return '/img/placeholder@2x.png';
    }

    public function getImages()
    {
        return $this->hasMany(PhotographerImage::className(), ['photographerId' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
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
