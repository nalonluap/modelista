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

class ContactRequest extends ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_DENIED = 2;

    public static function statusLabels()
    {
        return [
            self::STATUS_NEW      => 'Новый',
            self::STATUS_ACCEPTED => 'Принятый',
            self::STATUS_DENIED   => 'Отклоненный',
        ];
    }

    public static function tableName()
    {
        return '{{%contact_request}}';
    }

    public function rules()
    {
        return [
            [['senderUserId', 'recipientUserId'], 'integer'],
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'senderUserId' => 'Отправитель',
            'recipientUserId' => 'Получатель',
            'status' => 'Статус',
        ];
    }


    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'senderUserId']);
    }

    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'recipientUserId']);
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
