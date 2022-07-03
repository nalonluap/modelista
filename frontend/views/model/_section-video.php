<section class="model__content" id="video">
  <div class="container">

    <div class="model__section">
      <div class="model__section-title">
        <span>Промо видео</span>
          <?php if ($isProfile): ?>
            <a href="/profile/edit?scrollTo=video" class="btn border-btn">Изменить</a>
          <?php endif; ?>
      </div>

      <div class="card">

        <iframe width="1280" height="480" src="https://www.youtube.com/embed/<?= $model->video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


        <?php if ($isProtected): ?>
          <?= $this->render('_protected') ?>
        <?php endif; ?>

      </div>

    </div>

  </div>
</section>
