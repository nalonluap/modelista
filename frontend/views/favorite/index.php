<?php
use common\models\Data;
use common\models\Favorite;
use yii\widgets\ListView;

$this->title = 'Modelista - избранное';
$this->params['class'] = 'favorite-page';
?>




<section>
  <div class="container">
    <h2 class="favorite__title">Модели</h2>

    <div class="favorite__row">
      <?php if (isset($models[ Favorite::TYPE_MODEL ]) AND sizeof($models[ Favorite::TYPE_MODEL ]) > 0): ?>
        <?php foreach ($models[ Favorite::TYPE_MODEL ] as $key => $model): ?>
            <?= $this->render('//model/_model-small-item', [
              'model' => $model,
            ]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty">К сожалению, здесь пока пусто...</div>
      <?php endif; ?>
    </div>


  </div>
</section>


<section>
  <div class="container">
    <h2 class="favorite__title">Фотографы</h2>

    <div class="favorite__row">
      <?php if (isset($models[ Favorite::TYPE_PHOTOGRAPHER ]) AND sizeof($models[ Favorite::TYPE_PHOTOGRAPHER ]) > 0): ?>
        <?php foreach ($models[ Favorite::TYPE_PHOTOGRAPHER ] as $key => $model): ?>
          <?= $this->render('//model/_model-small-item', [
            'model' => $model,
          ]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="empty">К сожалению, здесь пока пусто...</div>
      <?php endif; ?>
    </div>

  </div>
</section>
