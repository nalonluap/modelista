<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use yii\redactor\widgets\Redactor;
use yii\helpers\Url;

use common\models\User;

?>

<?php $form = ActiveForm::begin([
        'id' => 'Model',
        'layout' => 'horizontal',
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]
);
?>

<div class="card">

    <div class="card-header with-border">
    <h3 class="card-title">Модель</h3>
    <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i>
            </button>
    </div></div>


    <div class="card-body">

        <div class="review-form">


            <div class="">
                <?php echo $form->errorSummary($model); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'status')->dropDownList(User::statusLabels(), ['prompt' => '']) ?>

            </div>

        </div>

    </div>

    <div class="card-footer">
        <?= Html::submitButton(
            '<i class="far fa-check-circle"></i> ' . ($model->isNewRecord
                ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
            [
                'id' => 'save-' . $model->formName(),
                'class' => 'btn btn-success'
            ]
        );
        ?>
    </div>

</div>

<?php ActiveForm::end(); ?>
