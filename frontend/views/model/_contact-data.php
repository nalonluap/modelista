<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
?>

<div class="contact-data">

  <?php if ($user->status != User::STATUS_ACTIVE): ?>
    <div class="not-allowed">
      <h3>Почти готово</h3>
      <p>Спасибо за регистрацию в Modelista. Ваша учетная запись находится на рассмотрении. Вы сможете связаться с моделями, как только ваша учетная запись будет одобрена.</p>
    </div>
  <?php else: ?>

    <?php if ($model->isHiddenContacts AND !$checkRequest): ?>
      <div class="contact-request">
        <p>Контакты этого профиля скрыты. Хотите отправить запрос, чтобы получить их?</p>
        <a href="#" class="btn js-send-request" data-id="<?= $model->user->id ?>">Да, хочу получить</a>
      </div>
    <?php else: ?>

      <?php if (!empty($model->instagram) AND !is_null($model->instagram)): ?>
        <div class="contact-row">
          <div class="contact-row__title">Инстаграм</div>
          <div class="contact-row__value"><?= $model->instagram ?></div>
        </div>
      <?php endif; ?>

      <?php if (!empty($model->telegram) AND !is_null($model->telegram)): ?>
        <div class="contact-row">
          <div class="contact-row__title">Телеграм</div>
          <div class="contact-row__value"><?= $model->telegram ?></div>
        </div>
      <?php endif; ?>

      <div class="contact-row">
        <div class="contact-row__title">Почта</div>
        <div class="contact-row__value"><?= $model->user->email ?></div>
      </div>

      <?php if (!empty($model->phone) AND !is_null($model->phone)): ?>
        <div class="contact-row">
          <div class="contact-row__title">Телефон</div>
          <div class="contact-row__value"><?= $model->phone ?></div>
        </div>
      <?php endif; ?>

      <?php if (!empty($model->whatsapp) AND !is_null($model->whatsapp)): ?>
        <div class="contact-row">
          <div class="contact-row__title">Whatsapp</div>
          <div class="contact-row__value"><?= $model->whatsapp ?></div>
        </div>
      <?php endif; ?>

    <?php endif; ?>


  <?php endif; ?>

</div>
