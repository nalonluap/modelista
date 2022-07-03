<?php
use common\models\Data;
use common\models\User;
use common\helpers\FormatHelper;

$modelUser = $model->user;
$modelName = $modelUser->name . ' ' . $modelUser->surname;
?>

<div class="model-item">
  <div class="model-item__content">

    <header class="model-item__header">
      <a href="/model/<?= $model->id ?>" title="<?= $modelName ?>" class="avatar">
        <div class="img" style="background-image: url(<?= $model->avatarImage ?>);background-position: center;background-size: cover;"></div>
      </a>
      <div class="main-details">
        <div class="main-details__top">
          <a href="/model/<?= $model->id ?>" title="<?= $modelName ?>" class="name"><?= $modelName ?></a>
          <a href="#" class="favorite js-favorite-btn" data-id="<?= $model->id ?>" data-type="<?= User::TYPE_MODEL ?>">
            <svg class="Icon__icon--2u9lI" xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 20 18"><g fill-rule="nonzero" fill="none"><path fill="#222" fill-opacity=".09" fill-rule="evenodd" stroke="currentColor" stroke-opacity=".15" d="M10 3.087c1.612-1.803 4.088-2.5 6.25-1.85C18.531 1.923 20 3.94 20 6.816c0 1.447-.547 2.903-1.563 4.353-.859 1.227-2.03 2.417-3.437 3.555a30.715 30.715 0 0 1-3.438 2.397c-.41.248-.792.466-1.132.652l-.195.105-.235.125-.235-.125a29.68 29.68 0 0 1-1.328-.757A30.72 30.72 0 0 1 5 14.724c-1.406-1.138-2.578-2.328-3.438-3.555C.547 9.72 0 8.263 0 6.816 0 3.94 1.469 1.923 3.75 1.237c2.162-.65 4.638.047 6.25 1.85z"></path></g></svg>
          </a>
        </div>
        <div class="main-details__location">
          <?= Data::CITIES[ $model->city ] ?>
        </div>
      </div>
    </header>

    <div class="model-item__info">
      <div class="info-item">
        <div class="value"><?= FormatHelper::price($model->hourPrice, 0, '₽') ?></div>
        <div class="title">В час</div>
      </div>
      <div class="info-item">
        <div class="value"><?= FormatHelper::price($model->dayPrice, 0, '₽') ?></div>
        <div class="title">В день</div>
      </div>
      <div class="info-item">
        <div class="value">
          <div class="ico">
            <svg class="Icon__icon--2u9lI" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"><path fill="currentColor" fill-rule="nonzero" d="M5.54 1.077A4.545 4.545 0 0 0 1 5.617v6.92a4.545 4.545 0 0 0 4.54 4.54h6.92a4.545 4.545 0 0 0 4.54-4.54v-6.92a4.545 4.545 0 0 0-4.54-4.54H5.54zm0 1.298h6.92a3.222 3.222 0 0 1 3.243 3.243v6.919a3.222 3.222 0 0 1-3.244 3.243H5.541a3.222 3.222 0 0 1-3.244-3.243v-6.92a3.222 3.222 0 0 1 3.244-3.242zm7.784 1.297a.865.865 0 1 0 0 1.73.865.865 0 0 0 0-1.73zM9 4.752a4.334 4.334 0 0 0-4.324 4.325A4.334 4.334 0 0 0 9 13.402a4.334 4.334 0 0 0 4.324-4.325A4.334 4.334 0 0 0 9 4.753zM9 6.05a3.017 3.017 0 0 1 3.027 3.027A3.017 3.017 0 0 1 9 12.104a3.017 3.017 0 0 1-3.027-3.027A3.017 3.017 0 0 1 9 6.05z"></path></svg>
          </div>
          <span class="<?= (!empty($model->instagram) AND !is_null($model->instagram)) ? 'js-instagram-followers' : '' ?>" data-id="<?= $model->id ?>" data-instagram="<?= $model->instagram ?>">
            <?= (!empty($model->instagramCount) AND !is_null($model->instagramCount)) ? $model->instagramCount : '-' ?>
          </span>
        </div>
        <div class="title">Подписчиков</div>
      </div>
    </div>

    <div class="model-item__actions">
      <a href="/model/<?= $model->id ?>" title="<?= $modelName ?>" class="btn border-btn">Портфолио</a>
      <a href="#" class="btn js-show-contact" data-id="<?= $model->id ?>" data-type="<?= User::TYPE_MODEL ?>">Контакты</a>
    </div>

  </div>
  <div class="model-item__photos">

    <div class="gallery-meta" data-for="model-<?= $model->id ?>">
      <div class="_id"><?= $model->id ?></div>
      <div class="_name"><?= $modelName ?></div>
      <div class="_price"><?= FormatHelper::price($model->hourPrice, 0, '₽') ?>/час • <?= FormatHelper::price($model->dayPrice, 0, '₽') ?>/день</div>
      <div class="_location"><?= Data::CITIES[ $model->city ] ?></div>
      <div class="_imagesCount"><?= sizeof($model->images) ?></div>
      <div class="meta-params">
        <div class="_height"><?= $model->height ?>см.</div>
        <div class="_weight"><?= $model->weight ?>кг.</div>
        <div class="_age"><?= $model->age ?></div>
        <div class="_shoes"><?= $model->shoes ?></div>
        <div class="_shirt"><?= $model->shirt ?></div>
        <div class="_bust"><?= $model->bust ?></div>
        <div class="_ethnicity"><?= Data::ETHNICITY[ $model->ethnicity ] ?></div>
        <div class="_eyes"><?= Data::EYES[ $model->eyes ] ?></div>
        <div class="_hair"><?= Data::HAIR[ $model->hair ] ?></div>
        <div class="_tattoo"><?= Data::TATTOO[ $model->tattoo ] ?></div>
      </div>
      <div class="meta-images">
        <?php foreach ($model->images as $key => $image): ?>
          <div data-position="<?= $key ?>" data-id="<?= $image->id ?>" data-src="<?= $image->imageThumbWithPath ?>"></div>
        <?php endforeach; ?>
      </div>
    </div>


    <?php $counter = 0; ?>
    <?php foreach ($model->images as $key => $image): ?>
      <?php if ($counter > 3) { break; } ?>
      <div class="model-item__photo js-open-gallery" data-for="model-<?= $model->id ?>" data-position="<?= $key ?>">
        <div class="overlay">
          <div class="ico">
            <svg class="Icon__icon--2u9lI" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 20"><g fill="none" fill-rule="evenodd"><ellipse cx="16.4" cy="10" stroke="currentColor" stroke-width="2.592" rx="3.785" ry="3.75"></ellipse><ellipse cx="15.138" cy="8.75" fill="currentColor" fill-rule="nonzero" rx="1.262" ry="1.25"></ellipse><path fill="currentColor" d="M0 10l2.068-1.577L4.138 10l2.622 2.003 3.486 2.653a10.166 10.166 0 0 0 12.308 0l4.046-3.084 2.07 1.577-4.579 3.489a12.706 12.706 0 0 1-15.382 0l-6.64-5.06L0 10zm30.732 1.577L32.8 10l-2.068-1.577-6.64-5.06a12.706 12.706 0 0 0-15.383 0L4.134 6.85l2.07 1.577 4.042-3.082a10.167 10.167 0 0 1 12.308 0l3.835 2.913L28.662 10l2.07 1.577z"></path></g></svg>
          </div>
          <span class="text">Быстрый просмотр</span>
        </div>
        <div class="photo">
          <img data-src="<?= $image->imageThumbWithPath ?>" class="lazyload" />
        </div>
      </div>
      <?php $counter++; ?>
    <?php endforeach; ?>



  </div>
</div>
