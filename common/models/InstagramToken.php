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

class InstagramToken extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%instagram_token}}';
    }

    public function rules()
    {
        return [
            [['token'], 'string'],
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
            'token' => 'Токен',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }


    public function check()
    {
      $created = strtotime($this->updated);
      $now = strtotime(date('m/d/Y h:i:s a', time()));
      $seconds = abs($now - $created);
      $days = floor($seconds / 86400);

      if ($days < 1) {
        return true;
      }

      return false;
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
