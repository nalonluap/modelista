<?php
use yii\widgets\ActiveForm;
use common\models\User;

$this->title = 'Modelista - регистрация';
$this->params['class'] = 'auth';
?>

<div class="auth__page">

  <?php $form = ActiveForm::begin([
      'id' => 'registerForm',
      'validateOnSubmit' => false,
      'enableClientScript' => false
    ]) ?>


    <?php if (!isset($_GET['type'])): ?>
      <div class="form select-type" id="regTypeForm">
        <div class="form__header">
          <h3>Укажите кем Вы являетесь</h3>
        </div>
        <div class="form__content">

          <div class="select-type__labels">


            <div class="form-group field-registerform-type">

              <input type="hidden" name="RegisterForm[type]" value="">
              <div id="registerform-type" role="radiogroup">
                <a href="/auth/register?type=0" class="select-type__label">
                  <input type="radio" name="RegisterForm[type]" value="0" tabindex="3">
                  <div class="ico">1</div>
                  <div class="subtitle">Модель</div>
                </a>
                <a href="/auth/register?type=1" class="select-type__label">
                  <input type="radio" name="RegisterForm[type]" value="1" tabindex="3">
                  <div class="ico">2</div>
                  <div class="subtitle">Фотограф</div>
                </a>
                <a href="/auth/register-company" class="select-type__label"><input type="radio" name="RegisterForm[type]" value="2" tabindex="3">
                  <div class="ico">3</div>
                  <div class="subtitle">Компания</div>
                </a>
              </div>

              <div class="help-block"></div>
            </div>


            <!-- <
                      $form->field($model, 'type')
                          ->radioList(
                              User::typeLabels(),
                              [
                                  'item' => function($index, $label, $name, $checked, $value) {

                                      $return = '<label class="select-type__label">';
                                      $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                      $return .= '<div class="ico">'.($index+1).'</div>';
                                      $return .= '<div class="subtitle">' . ucwords($label) . '</div>';
                                      $return .= '</label>';

                                      return $return;
                                  }
                              ]
                          )
                      ->label(false);
                      ?> -->


          </div>

        </div>
      </div>
    <?php else: ?>

      <div class="form" id="regMainForm">
        <div class="form__header">
          <h3>Регистрация</h3>
        </div>
        <div class="form__content">


          <div class="form__row">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Ваша фамилия', 'class' => 'form-input']) ?>
          </div>

          <?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => 'Ваш Email', 'class' => 'form-input']) ?>
          <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Ваш пароль', 'class' => 'form-input']) ?>


          <div class="form__actions">
            <button type="submit" class="btn">Продолжить</button>
            <a href="/auth">Вход</a>
          </div>

          <div class="form__footer">
            <div class="agreement">
              Продолжая, я соглашаюсь и принимаю <a href="/privacy-policy">Политику конфиденциальности</a>
            </div>
          </div>

        </div>
      </div>

    <?php endif; ?>


    <?= $form->field($model, 'type')->hiddenInput(['value' => isset($_GET['type']) ? $_GET['type'] : 0])->label(''); ?>


    <?php ActiveForm::end(); ?>


</div>
