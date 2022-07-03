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

class ImageCompress extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%image_compress}}';
    }

    public function rules()
    {
        return [
          [['imgPath', 'error', 'inputSize', 'outputSize', 'diff', 'outputUrl'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }


}
