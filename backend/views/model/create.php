<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Create new');
$this->params['menuItem'] = 'model';
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create model-create">

    <p class="pull-left">
        <?= Html::a(Yii::t('app', 'Cancel'), $this->params['baseUrl'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

    <?= $this->render('_form', [
      'model' => $model,
    ]); ?>

</div>
