<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_NOT_CONFIRM = 3;

    const STATUS_EMPTY_MODEL = 4;
    const STATUS_EMPTY_PHOTOGRAPHER = 5;
    const STATUS_EMPTY_COMPANY = 6;

    const STATUS_FILLED_MODEL = 7;
    const STATUS_FILLED_PHOTOGRAPHER = 8;
    const STATUS_FILLED_COMPANY = 9;


    const TYPE_MODEL = 0;
    const TYPE_PHOTOGRAPHER = 1;
    const TYPE_COMPANY = 2;

    public static function typeLabels()
    {
        return [
            self::TYPE_MODEL        => 'Модель',
            self::TYPE_PHOTOGRAPHER => 'Фотограф',
            self::TYPE_COMPANY      => 'Компания',
        ];
    }

    public static function typeSlug()
    {
        return [
            self::TYPE_MODEL        => 'model',
            self::TYPE_PHOTOGRAPHER => 'photographer',
            self::TYPE_COMPANY      => 'company',
        ];
    }

    public static function statusLabels()
    {
        return [
            self::STATUS_ACTIVE              => 'Активен',
            self::STATUS_INACTIVE            => 'Не активен',
            self::STATUS_DELETED             => 'Удален',
            self::STATUS_NOT_CONFIRM         => 'Не подтвержден',
            self::STATUS_EMPTY_MODEL         => 'Пустая модель',
            self::STATUS_EMPTY_PHOTOGRAPHER  => 'Пустой фотограф',
            self::STATUS_FILLED_MODEL        => 'Заполненная модель',
            self::STATUS_FILLED_PHOTOGRAPHER => 'Заполненный фотограф',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'string', 'max' => 255],
            ['type', 'integer'],
            ['status', 'default', 'value' => self::STATUS_NOT_CONFIRM],
            // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            // 'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getEntity()
    {
      if ($this->type == User::TYPE_MODEL) {
        $model = Model::find()->where(['userId' => $this->id])->one();
        if(!is_object($model)) {
          $model = new Model();
          $model->userId = $this->id;
          $model->save();
        }
      } else if ($this->type == User::TYPE_PHOTOGRAPHER) {
        $model = Photographer::find()->where(['userId' => $this->id])->one();
        if(!is_object($model)) {
          $model = new Photographer();
          $model->userId = $this->id;
          $model->save();
        }
      } else if ($this->type == User::TYPE_COMPANY) {

      }
      return $model;
    }

    public function getFavorites()
    {
      return $this->hasMany(Favorite::className(), ['userId' => 'id']);
    }


    public function getNotifications()
    {
      $notifications = Notification::find()->where(['recipientUserId' => $this->id])->orderBy(['id' => SORT_DESC])->all();
      foreach ($notifications as $notification) {
        if($notification->isRead == false) {
          $notification->isRead = true;
          $notification->save();
        }
      }
      return $notifications;
    }

    public function getIsUnreadNotifications()
    {
      return is_object(Notification::find()->where(['recipientUserId' => $this->id])->andWhere(['isRead' => false])->one()) ? true :false;
    }

    public function getInstagramToken()
    {
      $token = InstagramToken::find()->where(['userId' => $this->id])->one();
      if (is_object($token)) {
        return $token;
      }
      return false;
    }

    public function hasInstagramToken()
    {
      return is_object($this->instagramToken) ? ( !is_null($this->instagramToken->token) ? true : false ) : false;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Email',
        ];
    }
}
