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

class PhotographerImage extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%photographer_image}}';
    }

    public function rules()
    {
        return [
            [['image'], 'string', 'max' => 255],
            [['photographerId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photographerId' => 'Фоторaф',
            'image' => 'Изображение',
        ];
    }

    public function getPhotographer()
    {
        return $this->hasOne(Photographer::className(), ['id' => 'photographerId']);
    }

    public function getImageWithPath()
    {
      return '/upload/'.$this->photographer->userId.'/' . $this->image;
      // return Yii::getAlias('@upload/all/' . $this->image);
    }

    public function getImageThumbWithPath()
    {
      return '/upload/'.$this->photographer->userId.'/thumbnails/' . $this->image;
      // return Yii::getAlias('@upload/all/' . $this->image);
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
