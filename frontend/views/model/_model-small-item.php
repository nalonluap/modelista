<?php
use common\models\Data;
use common\models\User;
use common\helpers\FormatHelper;

$model = $model->entity;
$modelUser = $model->user;
$modelName = $modelUser->name . ' ' . $modelUser->surname;

if ($modelUser->type == User::TYPE_MODEL) {
  $modelUrl = '/model/';
} else if ($modelUser->type == User::TYPE_PHOTOGRAPHER) {
  $modelUrl = '/photographer/';
}
$modelUrl .= $model->id;
?>

<div class="small-item">
  <div class="small-item__images">

    <!-- <a href="#" class="small-item__slider-arrow _left js-small-item-slider-prev">
      <svg _ngcontent-c29="" class="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c29="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="square" stroke-width="2"><path _ngcontent-c29="" d="M12.378 23.788l8-8M17.33 12.901l-4.952-4.69"></path></g></svg>
    </a>

    <a href="#" class="small-item__slider-arrow _right js-small-item-slider-next">
      <svg _ngcontent-c29="" class="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c29="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="square" stroke-width="2"><path _ngcontent-c29="" d="M12.378 23.788l8-8M17.33 12.901l-4.952-4.69"></path></g></svg>
    </a> -->

    <div class="small-item__slider js-small-item-slider">
      <?php $counter = 0; ?>
      <?php foreach ($model->images as $key => $image): ?>
        <?php if ($counter > 7) { break; } ?>
        <div class="small-item__photo">
          <div class="photo">
            <img data-src="<?= $image->imageThumbWithPath ?>" class="lazyload" />
          </div>
        </div>
        <?php $counter++; ?>
      <?php endforeach; ?>
    </div>

  </div>
  <div class="small-item__content">
    <div class="main-details">
      <div class="main-details__top">
        <a href="<?= $modelUrl ?>" title="<?= $modelName ?>" class="name"><?= $modelName ?></a>
        <a href="#" class="favorite js-favorite-btn" data-id="<?= $model->id ?>" data-type="<?= $modelUser->type ?>">
          <svg class="Icon__icon--2u9lI" xmlns="http://www.w3.org/2000/svg" width="21" height="18" viewBox="0 0 20 18"><g fill-rule="nonzero" fill="none"><path fill="#222" fill-opacity=".09" fill-rule="evenodd" stroke="currentColor" stroke-opacity=".15" d="M10 3.087c1.612-1.803 4.088-2.5 6.25-1.85C18.531 1.923 20 3.94 20 6.816c0 1.447-.547 2.903-1.563 4.353-.859 1.227-2.03 2.417-3.437 3.555a30.715 30.715 0 0 1-3.438 2.397c-.41.248-.792.466-1.132.652l-.195.105-.235.125-.235-.125a29.68 29.68 0 0 1-1.328-.757A30.72 30.72 0 0 1 5 14.724c-1.406-1.138-2.578-2.328-3.438-3.555C.547 9.72 0 8.263 0 6.816 0 3.94 1.469 1.923 3.75 1.237c2.162-.65 4.638.047 6.25 1.85z"></path></g></svg>
        </a>
      </div>
      <div class="main-details__location">
        <?= Data::CITIES[ $model->city ] ?>
      </div>
    </div>
    <div class="small-item__actions">
      <a href="<?= $modelUrl ?>" title="<?= $modelName ?>" class="btn border-btn">Портфолио</a>
      <a href="#" class="btn js-show-contact" data-id="<?= $model->id ?>" data-type="<?= $modelUser->type ?>">Контакты</a>
    </div>
  </div>
</div>
