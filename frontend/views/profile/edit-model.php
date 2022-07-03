<?php
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Data;

$this->title = 'Modelista - редактирование профиля';
$this->params['class'] = 'profile edit-profile';
?>


<section>
  <div class="container">

    <h2>Настройка профиля</h2>

    <?php if (isset($_GET['scrollTo'])): ?>
      <input type="hidden" id="scrollTo" value="<?= $_GET['scrollTo'] ?>" data-offset="80">
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => 'editForm',
        'validateOnSubmit' => false,
        'enableClientScript' => false,
        'options' => ['enctype' => 'multipart/form-data'],
      ]) ?>

      <div class="form">
        <div class="form__header">
          <h3>Основные данные</h3>
        </div>
        <div class="form__content">


          <div class="avatar-wrap">
            <div class="avatar js-img-preview" data-for="Model[avatarFile]" style="background-image: url(<?= $model->avatarImage ?>);background-position: center;background-size: cover;"></div>
            <a href="#" class="btn border-btn js-file-btn" data-for="Model[avatarFile]">Загрузить фото</a>
            <!-- <input type="file" name="Model[avatarFile]" class="hidden js-file-input"> -->
            <?= $form->field($model, 'avatarFile')->fileInput(['class' => 'hidden js-file-input'])->label('') ?>
          </div>


          <div class="form__row">
            <?= $form->field($user, 'name')->textInput(['placeholder' => 'Ваше имя', 'class' => 'form-input']) ?>
            <?= $form->field($user, 'surname')->textInput(['placeholder' => 'Ваша фамилия', 'class' => 'form-input']) ?>
          </div>

          <div class="form__row">
            <?= $form->field($user, 'email')->textInput(['type' => 'email', 'placeholder' => 'Ваш Email', 'class' => 'form-input', 'disabled' => true]) ?>
            <?= $form->field($model, 'city')->dropDownList(Data::CITIES) ?>
          </div>

          <div class="form__row">
            <?= $form->field($model, 'gender')->dropDownList(Data::GENDER) ?>
            <?= $form->field($model, 'categoryId')->dropDownList(array_column(Data::CATEGORIES, 'title')) ?>
            <?= $form->field($model, 'age')->textInput(['type' => 'number', 'placeholder' => 'Ваш возраст', 'class' => 'form-input']) ?>
          </div>

          <div class="form__row">
            <?= $form->field($model, 'hourPrice')->textInput(['type' => 'number', 'placeholder' => 'Стоимость Вашего часа', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'dayPrice')->textInput(['type' => 'number', 'placeholder' => 'Стоимость Вашего дня', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'tfp')->dropDownList(['Нет', 'Да']) ?>
          </div>


        </div>
      </div>



      <div class="form" id="instagram">
        <div class="form__header">
          <h3>Инстаграм</h3>
        </div>
        <div class="form__content">

          <?php if ($user->hasInstagramToken()): ?>
            <a href="/profile/instagram" class="btn">Управлять фотографиями инстаграм</a>
          <?php else: ?>
            <a href="#" class="btn js-instagram-connect">Подключить инстаграм</a>
          <?php endif; ?>

        </div>
      </div>




      <div class="form" id="contacts">
        <div class="form__header">
          <h3>Контакты</h3>
        </div>
        <div class="form__content">
          <div class="form__pre">Здесь Вы можете указать свой соц. сети, если они есть</div>

          <?= $form->field($model, 'isHiddenContacts')->dropDownList(['Нет', 'Да']) ?>
          <p style="margin-top:-24px;margin-bottom:32px;">Если вы решите скрыть свои контакты, то их будут видеть только одобренные вами пользователи</p>


          <?= $form->field($model, 'instagram')->textInput(['placeholder' => 'Ваш инстаграм', 'class' => 'form-input']) ?>
          <?= $form->field($model, 'telegram')->textInput(['placeholder' => 'Ваш телеграм', 'class' => 'form-input']) ?>
          <?= $form->field($model, 'whatsapp')->textInput(['placeholder' => 'Ваш whatsapp', 'class' => 'form-input']) ?>
          <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Ваш телефон', 'class' => 'form-input']) ?>
        </div>
      </div>


      <div class="form">
        <div class="form__header">
          <h3>Особенности внешности</h3>
        </div>
        <div class="form__content">


          <div class="form__row">
            <?= $form->field($model, 'height')->textInput(['type' => 'number', 'placeholder' => 'Ваш рост', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'weight')->textInput(['type' => 'number', 'placeholder' => 'Ваш вес', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'shoes')->textInput(['type' => 'number', 'placeholder' => 'Размер обуви', 'class' => 'form-input']) ?>
          </div>

          <div class="form__row">
            <?= $form->field($model, 'shirt')->textInput(['type' => 'number', 'placeholder' => 'Размер одежды', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'bust')->textInput(['type' => 'number', 'placeholder' => 'Размер груди', 'class' => 'form-input']) ?>
            <?= $form->field($model, 'tattoo')->dropDownList(Data::TATTOO) ?>
          </div>

          <div class="form__row">
            <?= $form->field($model, 'eyes')->dropDownList(Data::EYES) ?>
            <?= $form->field($model, 'hair')->dropDownList(Data::HAIR) ?>
            <?= $form->field($model, 'ethnicity')->dropDownList(Data::ETHNICITY) ?>
          </div>


        </div>
      </div>


      <div class="form" id="portfolio">
        <div class="form__header">
          <h3>Портфолио</h3>
        </div>
        <div class="form__content">

          <div class="add-photos-wrap">
            <input type="file" name="Model[images][]" class="hidden js-images-file-input" multiple accept="image/*">

            <?php
            $imagesCount = sizeof($model->images);
            ?>
            <?php if ($imagesCount > 0): ?>
              <?php foreach ($model->images as $key => $image): ?>
                <div class="add-photo-item" style="background-image: url('<?= $image->imageWithPath ?>');background-position: center;background-size: cover;">
                  <a href="#" class="img-remove-btn js-remove-img-btn" data-id="<?= $image->id ?>">х</a>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <div class="add-photo-item js-file-btn _add" data-for="Model[images][]"><img src="/img/plus.png" alt="plus"></div>

            <?php for ($i = $imagesCount; $i < 5; $i++): ?>
              <div class="add-photo-item _empty"></div>
            <?php endfor; ?>

          </div>


        </div>
      </div>



      <div class="form" id="digitals">
        <div class="form__header">
          <h3>Снэпшоты</h3>
        </div>
        <div class="form__content">

          <div class="form__pre">Здесь Вы можете добавить свои фотографии с разных ракурсов</div>


          <div class="add-photos-wrap _digitals">
            <?= $form->field($model, 'digitFile_1')->fileInput(['class' => 'hidden js-file-input'])->label('') ?>
            <?= $form->field($model, 'digitFile_2')->fileInput(['class' => 'hidden js-file-input'])->label('') ?>
            <?= $form->field($model, 'digitFile_3')->fileInput(['class' => 'hidden js-file-input'])->label('') ?>
            <?= $form->field($model, 'digitFile_4')->fileInput(['class' => 'hidden js-file-input'])->label('') ?>
            <!-- <input type="file" name="Model[digital_1]" class="hidden js-file-input" accept="image/*">
            <input type="file" name="Model[digital_2]" class="hidden js-file-input" accept="image/*">
            <input type="file" name="Model[digital_3]" class="hidden js-file-input" accept="image/*">
            <input type="file" name="Model[digital_4]" class="hidden js-file-input" accept="image/*"> -->


            <div class="digital-col">
              <div class="add-photo-item _digital js-file-btn js-img-preview <?= (is_null($model->digit_1) OR empty($model->digit_1)) ? '_empty' : '' ?>" data-for="Model[digitFile_1]" style="background-image: url(<?= $model->digit1Image ?>);background-position: center;background-size: cover;">
                <img src="/img/plus.png" alt="plus" class="plus">
                <?php if (!is_null($model->digit_1) AND !empty($model->digit_1)): ?>
                  <a href="#" class="img-remove-btn js-remove-digit-btn" data-type="digit_1">х</a>
                <?php endif; ?>
              </div>
              <div class="add-photo-item _digital js-file-btn js-img-preview <?= (is_null($model->digit_2) OR empty($model->digit_2)) ? '_empty' : '' ?>" data-for="Model[digitFile_2]" style="background-image: url(<?= $model->digit2Image ?>);background-position: center;background-size: cover;">
                <img src="/img/plus.png" alt="plus" class="plus">
                <?php if (!is_null($model->digit_2) AND !empty($model->digit_2)): ?>
                  <a href="#" class="img-remove-btn js-remove-digit-btn" data-type="digit_2">х</a>
                <?php endif; ?>
              </div>
            </div>
            <div class="add-photo-item _digital digital-col js-file-btn js-img-preview <?= (is_null($model->digit_3) OR empty($model->digit_3)) ? '_empty' : '' ?>" data-for="Model[digitFile_3]" style="background-image: url(<?= $model->digit3Image ?>);background-position: center;background-size: cover;">
              <img src="/img/plus.png" alt="plus" class="plus">
              <?php if (!is_null($model->digit_3) AND !empty($model->digit_3)): ?>
                <a href="#" class="img-remove-btn js-remove-digit-btn" data-type="digit_3">х</a>
              <?php endif; ?>
            </div>
            <div class="add-photo-item _digital digital-col js-file-btn js-img-preview <?= (is_null($model->digit_4) OR empty($model->digit_4)) ? '_empty' : '' ?>" data-for="Model[digitFile_4]" style="background-image: url(<?= $model->digit4Image ?>);background-position: center;background-size: cover;">
              <img src="/img/plus.png" alt="plus" class="plus">
              <?php if (!is_null($model->digit_4) AND !empty($model->digit_4)): ?>
                <a href="#" class="img-remove-btn js-remove-digit-btn" data-type="digit_4">х</a>
              <?php endif; ?>
            </div>





          </div>


        </div>
      </div>


      <div class="form" id="pastClients">
        <div class="form__header">
          <h3>Последние места работы</h3>
        </div>
        <div class="form__content">
          <div class="form__pre">Здесь Вы можете указать компании/фотографов, с которыми Вы работали. Пожалуйста, указывайте названия (или имена) <b>через запятую</b></div>
          <?= $form->field($model, 'pastClients')->textInput(['placeholder' => 'Последние места работы через запятую', 'class' => 'form-input']) ?>
        </div>
      </div>

      <div class="form" id="video">
        <div class="form__header">
          <h3>Промо видео</h3>
        </div>
        <div class="form__content">
          <div class="form__pre">Здесь Вы можете указать видеоролик на YouTube с Вашим промо. Пожалуйста укажите только ту часть ссылки, что находится после символов "?v=", например, если ссылка на ваше видео выглядит вот так: "https://www.youtube.com/watch?v=20Ap1kH8wuU", то в поле ниже укажите только <b>20Ap1kH8wuU</b></div>
          <?= $form->field($model, 'video')->textInput(['placeholder' => 'Промо видео', 'class' => 'form-input']) ?>
        </div>
      </div>


      <div class="main-profile-btn-wrap">
        <button type="submit" class="btn main-profile-btn">Сохранить</button>
      </div>


    <?php ActiveForm::end(); ?>

  </div>
</section>
