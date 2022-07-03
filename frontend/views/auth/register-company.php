<?php
use yii\widgets\ActiveForm;
use common\models\User;

$this->title = 'Modelista - регистрация';
$this->params['class'] = 'auth';
?>


<?php if ($isSend): ?>
  <script>
    alert('Спасибо, ваш запрос получен! В ближайшее время мы ответим на него.');
  </script>
<?php endif; ?>


<div class="auth__page">

  <?php $form = ActiveForm::begin([
      'id' => 'registerCompanyForm',
      'validateOnSubmit' => false,
      'enableClientScript' => false
    ]) ?>



      <div class="form" id="regMainForm">
        <div class="form__header">
          <h3>Регистрация</h3>
        </div>
        <div class="form__content">


          <?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => 'Ваш Email', 'class' => 'form-input']) ?>
          <?= $form->field($model, 'text')->textarea(['placeholder' => 'Ваше сообщение', 'class' => 'form-input']) ?>


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


    <?php ActiveForm::end(); ?>


</div>
