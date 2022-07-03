<?php
use yii\widgets\ActiveForm;

$this->title = 'Modelista - вход';
$this->params['class'] = 'auth';
?>

<div class="auth__page">

  <?php $form = ActiveForm::begin([
      'id' => 'loginForm',
      'validateOnSubmit' => false,
      'enableClientScript' => false
    ]) ?>

    <div class="form">
      <div class="form__header">
        <h3>Авторизация</h3>
      </div>
      <div class="form__content">

        <?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => 'Ваш Email', 'class' => 'form-input']) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Ваш пароль', 'class' => 'form-input']) ?>


        <div class="form__actions">
          <button type="submit" class="btn">Войти</button>
          <a href="/auth/register">Регистрация</a>
        </div>

      </div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="auth__page-actions">
      <a href="/auth/forgot-pass" class="forgot-pass">Забыли пароль?</a>
    </div>

</div>
