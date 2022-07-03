<?php
use common\models\Data;
use yii\widgets\ListView;

$this->title = 'Modelista - фотографы';
$this->params['class'] = 'browse';
?>

<?= $this->render('_filter-photographer') ?>


<section class="categories">
  <div class="container">

    <div class="categories__scroll">

      <?php foreach (Data::CATEGORIES as $key => $cat): ?>
        <a href="/browse?categoryId=<?= $key ?>" class="category-item">
          <div class="category-item__img">
            <div class="img" style="background-image: url(/img/categories/<?= $cat['image'] ?>);background-position: center;background-size: cover;"></div>
          </div>
          <h3 class="category-item__title"><?= $cat['title'] ?></h3>
        </a>
      <?php endforeach; ?>

    </div>

  </div>
</section>


<section>
  <div class="container">

    <?= ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_photographer-item',
      'emptyText' => 'К сожалению, ничего не найдено...',
    ]) ?>

  </div>
</section>
