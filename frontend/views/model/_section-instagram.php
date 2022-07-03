<div class="gallery-meta" data-for="instagram" data-only-image="1">
  <div class="_imagesCount"><?= sizeof($model->instagramImages) ?></div>

  <div class="meta-images">
    <?php foreach ($model->instagramImages as $key => $image): ?>
      <div data-position="<?= $key ?>" data-id="<?= $image->id ?>" data-src="<?= $image->imageWithPath ?>"></div>
    <?php endforeach; ?>
  </div>
</div>


<section class="model__content" id="instagram">
  <div class="container">

    <div class="model__section">

      <div class="social-title">
        <div>
          <div class="title">Инстаграм</div>
          <div class="feed-info">Здесь отображается лента Instagram</div>
        </div>


        <?php if ($isProfile): ?>
          <?php $link = $model->user->hasInstagramToken() ? '/profile/instagram' : '/profile/edit?scrollTo=instagram'; ?>
          <a href="<?= $link ?>" class="btn border-btn">Изменить</a>
        <?php else: ?>
          <?php if ($model->instagramCount > 0): ?>
            <div class="instagram-count">
              <div class="ico">
                <svg _ngcontent-c34="" class="icon" height="18" viewBox="0 0 18 18" width="18" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-c34="" d="M5.54 1.077A4.545 4.545 0 0 0 1 5.617v6.92a4.545 4.545 0 0 0 4.54 4.54h6.92a4.545 4.545 0 0 0 4.54-4.54v-6.92a4.545 4.545 0 0 0-4.54-4.54H5.54zm0 1.298h6.92a3.222 3.222 0 0 1 3.243 3.243v6.919a3.222 3.222 0 0 1-3.244 3.243H5.541a3.222 3.222 0 0 1-3.244-3.243v-6.92a3.222 3.222 0 0 1 3.244-3.242zm7.784 1.297a.865.865 0 1 0 0 1.73.865.865 0 0 0 0-1.73zM9 4.752a4.334 4.334 0 0 0-4.324 4.325A4.334 4.334 0 0 0 9 13.402a4.334 4.334 0 0 0 4.324-4.325A4.334 4.334 0 0 0 9 4.753zM9 6.05a3.017 3.017 0 0 1 3.027 3.027A3.017 3.017 0 0 1 9 12.104a3.017 3.017 0 0 1-3.027-3.027A3.017 3.017 0 0 1 9 6.05z" fill="currentColor" fill-rule="nonzero"></path></svg>
              </div>
              <div class="value <?= (!empty($model->instagram) AND !is_null($model->instagram)) ? 'js-instagram-followers' : '' ?>" data-id="<?= $model->id ?>" data-instagram="<?= $model->instagram ?>">
                <?= (!empty($model->instagramCount) AND !is_null($model->instagramCount)) ? $model->instagramCount : '-' ?>
              </div>
              <div class="subtitle">followers</div>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div class="card _images _social">


        <?php foreach ($model->instagramImages as $key => $image): ?>
          <div class="model__image js-open-gallery"
               data-for="instagram"
               data-position="<?= $key ?>"
          >
            <img data-src="<?= $image->imageWithPath ?>" class="lazyload" />
          </div>
        <?php endforeach; ?>


          <!-- <div class="instagram-plug">
            <span>Загрузка...</span>
          </div> -->



        <?php if ($isProtected): ?>
          <?= $this->render('_protected') ?>
        <?php endif; ?>

      </div>

    </div>

  </div>
</section>
