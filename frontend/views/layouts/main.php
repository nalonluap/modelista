<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" xml:lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=0,width=device-width,height=device-height">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <?php if (!empty(Yii::$app->params[ 'testServer' ])):?>
        <meta name="robots" content="noindex, follow"/>
    <?php else: ?>
        <meta name="robots" content="noyaca">
    <?php endif ?>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta name="yandex-verification" content="4d2c9d68454b4615" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <!-- START INLINE CRITICAL --><style>

</style><!-- END INLINE CRITICAL -->

    <?= Html::cssFile(YII_ENV_DEV ? '@web/css/vendor.css?v='.time() : '@web/css/vendor.css?hash=227339ad28063cfc6948a12b01e4573ae7d58dff',['type'=>'text/css']) ?>
    <?= Html::cssFile(YII_ENV_DEV ? '@web/css/main.css?v='.time() : '@web/css/main.css?hash=24cb5847eadd968b6dd87d3e4846996b5e240f42',['type'=>'text/css']) ?>

    <?php $this->head() ?>

</head>
<body class="<?= isset($this->params['class']) ? $this->params['class'] : '' ?>">

  <?= $this->render('_header') ?>

  <div class="site-content">
    <?= $content ?>
  </div>

  <?= $this->render('_gallery') ?>


  <?php if (Url::to() == '/'): ?>
    <?= $this->render('_footer') ?>
  <?php else: ?>
    <?= $this->render('_site-footer') ?>
  <?php endif; ?>


  <?= $this->render('_modals') ?>

  <a href="https://t.me/modelista_app" title="Чат с нами в телеграм" class="telegramBtn" target="_blank"></a>


<script>
var favoriteModelIds = [];
var favoritePhotographerIds = [];
<?php if (!Yii::$app->user->isGuest): ?>
  <?php foreach (Yii::$app->user->identity->favorites as $key => $favorite): ?>
    <?php if ($favorite->type == \common\models\Favorite::TYPE_MODEL): ?>
      favoriteModelIds.push(<?= $favorite->entityId ?>);
    <?php elseif ($favorite->type == \common\models\Favorite::TYPE_PHOTOGRAPHER): ?>
      favoritePhotographerIds.push(<?= $favorite->entityId ?>);
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>
</script>


</body>

<?= Html::jsFile(YII_ENV_DEV ? '@web/js/vendor.js?v='.time() : '@web/js/vendor.js?hash=2d9f9b54b0523fbb82f1b7859c734b157add2c74',['defer'=>true]) ?>
<?= Html::jsFile(YII_ENV_DEV ? '@web/js/main.js?v='.time() : '@web/js/main.js?hash=672ec6e689d74f80a008c18bc8070debc512f7b8',['defer'=>true]) ?>

</html>
<?php $this->endPage() ?>
