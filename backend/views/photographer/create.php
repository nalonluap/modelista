<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Create new');
$this->params['menuItem'] = 'photographer';
$this->params['breadcrumbs'][] = ['label' => 'Фотографы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create photographer-create">

    <p class="pull-left">
        <?= Html::a(Yii::t('app', 'Cancel'), $this->params['baseUrl'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
      'model' => $model,
    ]); ?>

</div>
