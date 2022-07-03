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

class Favorite extends ActiveRecord
{

    const TYPE_MODEL = 0;
    const TYPE_PHOTOGRAPHER = 1;

    public static function typeLabels()
    {
        return [
            self::TYPE_MODEL        => 'Модель',
            self::TYPE_PHOTOGRAPHER => 'Фотограф',
        ];
    }

    public static function tableName()
    {
        return '{{%favorite}}';
    }

    public function rules()
    {
        return [
            [['userId', 'entityId', 'type'], 'integer'],
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


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getEntity()
    {
      if ($this->type == User::TYPE_MODEL) {
        return $this->hasOne(Model::className(), ['id' => 'entityId']);
      } else if ($this->type == User::TYPE_PHOTOGRAPHER) {
        return $this->hasOne(Photographer::className(), ['id' => 'entityId']);
      } else if ($this->type == User::TYPE_COMPANY) {

      }
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
