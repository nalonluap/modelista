<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use common\models\Notification;
use common\models\ContactRequest;

$user = Yii::$app->user->identity;
?>


<div class="notification-center">

  <div class="notification-center__header">
    <h3>Последние уведомления</h3>
  </div>

  <a href="#" class="notification-center__close js-notification-center-close">
    <svg _ngcontent-c54="" class="icon" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c54="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-width="2"><path _ngcontent-c54="" d="M8 8l16.986 16.986M19 14l6-6-6 6zM8 26l9-9"></path></g></svg>
  </a>

  <div class="notification-center__content">

    <?php if (sizeof($user->notifications) < 1): ?>

      <div class="empty">
        Тут ничего нет ;(
      </div>

    <?php else: ?>


      <?php foreach ($user->notifications as $notification): ?>
        <?php
          $sender = $notification->sender;
          $senderType = ($sender->type == User::TYPE_MODEL) ? 0 : ($sender->type == User::TYPE_PHOTOGRAPHER) ? 1 : 0;
          $senderLabel = (($senderType == 0) ? 'Модель' : (($senderType == 1) ? 'Фотограф' : 'Модель')) . ' <a href="/'. (($senderType == 0) ? 'model' : (($senderType == 1) ? 'photographer' : 'model')).'/'. $sender->entity->id .'" target="_blank">'.$sender->name.' '. $sender->surname .'</a>';
        ?>

        <?php if ($notification->type == Notification::TYPE_CONTACT_REQUEST): ?>

          <div class="notification">
            <div class="notification__header">
              <span><?= $senderLabel ?> просит доступ к вашим контактам</span>
            </div>
            <div class="notification__actions">
              <a href="#" class="btn light-btn js-notification-contact-btn _deny" data-id="<?= $notification->id ?>">
                <?php if ($notification->contactRequest->status == ContactRequest::STATUS_DENIED): ?>
                  Отклонено
                <?php else: ?>
                  Отклонить
                <?php endif; ?>
              </a>
              <a href="#" class="btn js-notification-contact-btn _accept" data-id="<?= $notification->id ?>">
                <?php if ($notification->contactRequest->status == ContactRequest::STATUS_ACCEPTED): ?>
                  Принято
                <?php else: ?>
                  Принять
                <?php endif; ?>
              </a>
            </div>
          </div>

        <?php elseif ($notification->type == Notification::TYPE_ACCEPTED_CONTACT_REQUEST): ?>

          <div class="notification">
            <div class="notification__header">
              <span><?= $senderLabel ?> принял(а) ваш запрос на контакты</span>
            </div>
            <div class="notification__actions">
              <a href="/<?= (($senderType == 0) ? 'model' : (($senderType == 1) ? 'photographer' : 'model')).'/'. $sender->entity->id ?>" target="_blank" class="btn light-btn">Профиль</a>
              <a href="#" class="btn js-show-contact" data-id="<?= $sender->entity->id ?>" data-type="<?= $sender->type ?>">Контакты</a>
            </div>
          </div>

        <?php elseif ($notification->type == Notification::TYPE_DENIED_CONTACT_REQUEST): ?>

          <div class="notification">
            <div class="notification__header">
              <span><?= $senderLabel ?> отклонил(а) ваш запрос на контакты</span>
            </div>
          </div>

        <?php endif; ?>


      <?php endforeach; ?>


    <?php endif; ?>


  </div>

</div>
