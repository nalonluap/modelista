<?php
use yii\helpers\Html;

$this->title = 'Редактирование модели';
$this->params['menuItem'] = 'model';
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name . ' ' . (string)$model->surname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="action-update model-update">

    <p>
      <?= Html::a(Yii::t('app', 'Cancel'), $this->params['baseUrl'], ['class' => 'btn btn-default']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
