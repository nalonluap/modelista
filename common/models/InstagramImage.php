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

class InstagramImage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%instagram_image}}';
    }

    public function rules()
    {
        return [
            [['image', 'caption', 'permalink', 'username', 'timestamp', 'instagramImageId'], 'string'],
            [['userId'], 'integer'],
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
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getImageWithPath()
    {
      return '/upload/'.$this->userId.'/instagram/' . $this->image;
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
