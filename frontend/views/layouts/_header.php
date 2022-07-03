<?php
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user->identity;
?>

<header class="main-header">
  <a href="/" class="logo main-logo">Modelista</a>


  <?php if (Url::to() != '/'): ?>
    <div class="main-header__center-menu">
      <a href="/browse" class="<?= (Url::to() == '/browse') ? '_active' : '' ?>">Модели</a>
      <a href="/browse/photographers" class="<?= (Url::to() == '/browse/photographers') ? '_active' : '' ?>">Фотографы</a>
      <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/browse/locations" class="<?= (Url::to() == '/browse/locations') ? '_active' : '' ?>">Локации</a>
        <a href="/favorite" class="<?= (Url::to() == '/favorite') ? '_active' : '' ?>">Избранное</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>


  <a href="#" class="menu-btn js-menu">
    <span></span>
    <span></span>
    <span></span>
  </a>

  <div class="main-menu-container js-main-menu">

    <?php if (Url::to() == '/'): ?>

      <a href="#model" class="site-menu-btn js-nav-scroll">Для моделей</a>
      <a href="#photographer" class="site-menu-btn js-nav-scroll">Для фотографов</a>
      <a href="#company" class="site-menu-btn js-nav-scroll">Компаниям</a>
      <a href="/browse" class="site-menu-btn browse-btn">База моделей</a>
      <?php if (Yii::$app->user->isGuest): ?>
        <a href="/auth" class="site-menu-btn login-btn">Войти</a>
        <a href="/auth/register" class="site-menu-btn signup-btn">Регистрация</a>
      <?php endif; ?>

    <?php else: ?>

          <div class="main-header__center-menu-mobile">
            <a href="/browse">Модели</a>
            <a href="/browse/photographers">Фотографы</a>
            <?php if (!Yii::$app->user->isGuest): ?>
              <a href="/browse/locations">Локации</a>
              <a href="/favorite">Избранное</a>
            <?php endif; ?>
          </div>

      <?php if (Yii::$app->user->isGuest): ?>
        <a href="/auth">Войти</a>
        <a href="/auth/register" class="signup">Регистрация</a>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest): ?>
      <div class="main-header__actions">
        <a href="#" class="action-link js-show-notification-center <?= $user->isUnreadNotifications ? '_new' : '' ?>" title="Уведомления">
          <svg class="Icon__icon--2u9lI HeaderItemNotifications__icon--sTRyK" width="18" height="22" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path stroke="currentColor" d="M2.70711 12.7071L3 12.4142V9c0-3.31371 2.68629-6 6-6 3.3137 0 6 2.68629 6 6v3.4142l.2929.2929L17 14.4142V17H1v-2.5858l1.70711-1.7071z" stroke-width="2"></path><path fill="currentColor" d="M6 19c0 1.65674 1.38379 3 3.09082 3 1.70703 0 3.09082-1.34326 3.09082-3h-2c0 .496338-.43164 1-1.09082 1C8.43164 20 8 19.496338 8 19H6z"></path><path stroke="currentColor" fill="currentColor" d="M9.5 1.5c0 .55228-.44772 1-1 1-.552285 0-1-.44772-1-1 0-.552285.447715-1 1-1 .55228 0 1 .447715 1 1z" fill-rule="nonzero"></path></g></svg>
        </a>
        <a href="/profile" class="main-user-ico" title="Профиль">
          <div class="img" style="background-image: url(<?= $user->entity->avatarImage ?>);background-position: center;background-size: cover;"></div>
        </a>

      </div>
    <?php endif; ?>

  </div>

  <?php if (!Yii::$app->user->isGuest): ?>
    <?= $this->render('_notification-center') ?>
  <?php endif; ?>

</header>
