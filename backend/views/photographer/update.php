<?php
use yii\helpers\Html;

$this->title = 'Редактирование фотографа';
$this->params['menuItem'] = 'photographer';
$this->params['breadcrumbs'][] = ['label' => 'Фотографы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name . ' ' . (string)$model->surname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="action-update photographer-update">

    <p>
      <?= Html::a(Yii::t('app', 'Cancel'), $this->params['baseUrl'], ['class' => 'btn btn-default']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
