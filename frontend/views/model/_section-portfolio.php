<div class="gallery-meta" data-for="images" data-only-image="1">
  <div class="_imagesCount"><?= sizeof($model->images) ?></div>

  <div class="meta-images">
    <?php foreach ($model->images as $key => $image): ?>
      <div data-position="<?= $key ?>" data-id="<?= $image->id ?>" data-src="<?= $image->imageThumbWithPath ?>"></div>
    <?php endforeach; ?>
  </div>
</div>

<section class="model__content" id="portfolio">
  <div class="container">

    <div class="model__section">

      <div class="model__section-title"><span>Портфолио</span></div>

      <div class="card _images">

        <?php foreach ($model->images as $key => $image): ?>
          <div class="model__image js-open-gallery"
               data-for="images"
               data-position="<?= $key ?>"
          >
            <img data-src="<?= $image->imageThumbWithPath ?>" class="lazyload" />
            <?php if ($isProfile): ?>
              <a href="#" class="img-remove-btn js-remove-img-btn" data-id="<?= $image->id ?>">х</a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

        <?php if ($isProfile): ?>
          <!-- <input type="file" name="Model[images][]" class="hidden js-profile-images-file-input" multiple accept="image/*">
          <div class="model__image add-photo-item js-file-btn _add" data-for="Model[images][]"><img src="/img/plus.png" alt="plus"></div> -->
          <a href="/profile/edit?scrollTo=portfolio" class="model__image add-photo-item _add"><img class="plus" src="/img/plus.png" alt="plus"></a>

        <?php endif; ?>


      </div>

    </div>

  </div>
</section>
