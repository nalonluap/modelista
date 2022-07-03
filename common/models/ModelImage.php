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

class ModelImage extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%model_image}}';
    }

    public function rules()
    {
        return [
            [['image'], 'string', 'max' => 255],
            [['modelId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modelId' => 'Модель',
            'image' => 'Изображение',
        ];
    }

    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'modelId']);
    }

    public function getImageWithPath()
    {
      return '/upload/'.$this->model->userId.'/' . $this->image;
      // return Yii::getAlias('@upload/all/' . $this->image);
    }

    public function getImageThumbWithPath()
    {
      return '/upload/'.$this->model->userId.'/thumbnails/' . $this->image;
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
