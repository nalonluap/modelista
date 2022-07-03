<section class="model__content" id="pastClients">
  <div class="container">

    <div class="model__section">

      <div class="model__section-title">
        <span>Последние работы</span>
          <?php if ($isProfile): ?>
            <a href="/profile/edit?scrollTo=pastClients" class="btn border-btn">Изменить</a>
          <?php endif; ?>
      </div>

      <div class="_past-clients">

        <?php foreach (explode(',', $model->pastClients) as $key => $value): ?>
          <span class="past-client"><?= trim($value) ?></span>
        <?php endforeach; ?>

      </div>

    </div>

  </div>
</section>
