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

class Notification extends ActiveRecord
{

    const TYPE_CONTACT_REQUEST = 0;
    const TYPE_ACCEPTED_CONTACT_REQUEST = 1;
    const TYPE_DENIED_CONTACT_REQUEST = 2;

    public static function typeLabels()
    {
        return [
            self::TYPE_CONTACT_REQUEST          => 'Запрос на контакты',
            self::TYPE_ACCEPTED_CONTACT_REQUEST => 'Подтвержденный запрос',
            self::TYPE_DENIED_CONTACT_REQUEST   => 'Отклоненный запрос',
        ];
    }

    public static function tableName()
    {
        return '{{%notification}}';
    }

    public function rules()
    {
        return [
            [['senderUserId', 'recipientUserId', 'type'], 'integer'],
            [['isRead'], 'boolean'],
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
            'type' => 'Тип',
            'isRead' => 'Прочитано',
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


    public function getContactRequest()
    {
        // return [$this->hasOne(ContactRequest::className(), ['senderUserId' => 'senderUserId', 'recipientUserId' => 'recipientUserId'])];
        return ContactRequest::find()
          ->where(['senderUserId' => $this->senderUserId])
          ->andWhere(['recipientUserId' => $this->recipientUserId])
        ->one();
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
