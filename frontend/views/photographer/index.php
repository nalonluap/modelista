<?php
use common\models\Data;
use common\models\User;
use common\helpers\FormatHelper;

if (!isset($isProfile)) { $isProfile = false; }
$modelUser = $model->user;
$modelName = $modelUser->name . ' ' . $modelUser->surname;

$isProtected = true;
if (!Yii::$app->user->isGuest) {
  if (Yii::$app->user->identity->status == User::STATUS_ACTIVE) {
    $isProtected = false;
  }
}
if ($isProfile) {
  $isProtected = false;
}

$this->title = 'Modelista - фотограф ' . $modelName;
$this->params['class'] = 'model photographer';
?>

<?php if (isset($check) AND $check): ?>
<section style="padding-top: 42px;">
  <div class="container" style="display:flex;justify-content:space-between;">
    <?php if ($model->user->status == User::STATUS_ACTIVE): ?>
      <b>Активный пользователь!</b>
      <a href="/profile/change-status?status=<?= User::STATUS_DELETED ?>&id=<?= $model->userId ?>" class="btn">Удалить</a>
    <?php elseif (in_array($model->user->status, [User::STATUS_EMPTY_PHOTOGRAPHER, User::STATUS_FILLED_PHOTOGRAPHER])): ?>
      <b>Новый пользователь!</b>
      <a href="/profile/change-status?status=<?= User::STATUS_ACTIVE ?>&id=<?= $model->userId ?>" class="btn">Подтвердить</a>
    <?php elseif ($model->user->status == User::STATUS_DELETED): ?>
      <b>Удаленный пользователь!</b>
      <a href="/profile/change-status?status=<?= User::STATUS_ACTIVE ?>&id=<?= $model->userId ?>" class="btn">Восстановить</a>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>


<section class="model__header">
  <div class="container">

    <div class="profile-top">
      <div class="profile-top__content">
        <div class="avatar">
          <div class="img" style="background-image: url(<?= $model->avatarImage ?>);background-position: center;background-size: cover;"></div>
        </div>
        <div class="main-details">
          <div class="main-details__top">
            <a href="/model/<?= $model->id ?>" class="name"><?= $modelName ?></a>
            <?php if (!$isProfile): ?>
              <a href="#" class="favorite js-favorite-btn" data-id="<?= $model->id ?>" data-type="<?= $modelUser->type ?>">
                <svg class="Icon__icon--2u9lI" xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 20 18"><g fill-rule="nonzero" fill="none"><path fill="#222" fill-opacity=".09" fill-rule="evenodd" stroke="currentColor" stroke-opacity=".15" d="M10 3.087c1.612-1.803 4.088-2.5 6.25-1.85C18.531 1.923 20 3.94 20 6.816c0 1.447-.547 2.903-1.563 4.353-.859 1.227-2.03 2.417-3.437 3.555a30.715 30.715 0 0 1-3.438 2.397c-.41.248-.792.466-1.132.652l-.195.105-.235.125-.235-.125a29.68 29.68 0 0 1-1.328-.757A30.72 30.72 0 0 1 5 14.724c-1.406-1.138-2.578-2.328-3.438-3.555C.547 9.72 0 8.263 0 6.816 0 3.94 1.469 1.923 3.75 1.237c2.162-.65 4.638.047 6.25 1.85z"></path></g></svg>
              </a>
            <?php endif; ?>
          </div>
          <div class="main-details__location">
            <?= Data::CITIES[ $model->city ] ?>
          </div>
        </div>
      </div>
      <div class="profile-top__actions">
        <div class="model-item__info">
          <div class="info-item">
            <div class="value"><?= FormatHelper::price($model->hourPrice, 0, '₽') ?></div>
            <div class="title">В час</div>
          </div>
          <div class="info-item">
            <div class="value"><?= FormatHelper::price($model->dayPrice, 0, '₽') ?></div>
            <div class="title">В день</div>
          </div>
        </div>
        <div class="profile-top__btns">
          <?php if ($isProfile): ?>
            <a href="/profile/edit" class="btn border-btn">Редактировать</a>
            <a href="/auth/logout" class="btn">Выйти</a>
          <?php else: ?>
            <a href="#" class="btn border-btn js-write-btn">Написать</a>
            <a href="#" class="btn js-show-contact" data-id="<?= $model->id ?>" data-type="<?= User::TYPE_PHOTOGRAPHER ?>">Контакты</a>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</section>


<section class="model__menu">

  <div></div>
  <div class="model__menu-content">
    <?php if (sizeof($model->images) > 0 OR $isProfile): ?>
      <a href="#portfolio" class="js-nav-scroll" data-offset="30">Портфолио</a>
    <?php endif; ?>
    <?php if (!empty($model->instagramImages) AND !is_null($model->instagramImages)): ?>
      <a href="#instagram" class="js-nav-scroll" data-offset="30">Инстаграм</a>
    <?php endif; ?>
    <?php if (!empty($model->pastClients) AND !is_null($model->pastClients)): ?>
      <a href="#pastClients" class="js-nav-scroll" data-offset="30">Последние клиенты</a>
    <?php endif; ?>
    <?php if (!empty($model->video) AND !is_null($model->video)): ?>
      <a href="#video" class="js-nav-scroll" data-offset="30">Видео</a>
    <?php endif; ?>
  </div>
  <div></div>

</section>


<?php if (sizeof($model->images) > 0 OR $isProfile): ?>
  <?= $this->render('//model/_section-portfolio', [
    'model' => $model,
    'isProfile' => $isProfile,
    'isProtected' => $isProtected,
  ]) ?>
<?php endif; ?>


<?php if (!empty($model->instagramImages) AND !is_null($model->instagramImages)): ?>
  <?= $this->render('//model/_section-instagram', [
    'model' => $model,
    'isProfile' => $isProfile,
    'isProtected' => $isProtected,
  ]) ?>
<?php endif; ?>

<?php if (!empty($model->pastClients) AND !is_null($model->pastClients)): ?>
  <?= $this->render('//model/_section-past-clients', [
    'model' => $model,
    'isProfile' => $isProfile,
    'isProtected' => $isProtected,
  ]) ?>
<?php endif; ?>


<?php if (!empty($model->video) AND !is_null($model->video)): ?>
  <?= $this->render('//model/_section-video', [
    'model' => $model,
    'isProfile' => $isProfile,
    'isProtected' => $isProtected,
  ]) ?>
<?php endif; ?>
