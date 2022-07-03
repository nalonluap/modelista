<?php
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Data;

$this->title = 'Modelista - подключение instagram';
$this->params['class'] = 'profile edit-profile';

$existImages = array_column($model->instagramImages, 'instagramImageId');
?>


<section>
  <div class="container">

    <h2>Настройка инстаграм</h2>

    <form id="instagramForm" action="/profile/instagram" method="post">
      <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />


      <div class="form" id="portfolio">
        <div class="form__header">
          <h3>@<?= $profile->username ?></h3>
        </div>
        <div class="form__content">
          <div class="form__pre">Выберите фотографии, которые хотите добавить в свой профиль</div>


          <div class="add-photos-wrap">

            <?php if (sizeof($images->data) > 0): ?>
              <?php foreach ($images->data as $key => $image): ?>
                <?php
                  $selected = in_array($image->id, $existImages) ? true : false;
                ?>
                <div class="add-photo-item _instagram js-instagram-img <?= $selected ? '_selected' : '' ?>" style="background-image: url('<?= $image->media_url ?>');background-position: center;background-size: cover;background-repeat:no-repeat;">
                  <input type="checkbox" name="<?= $image->id ?>" value="<?= $image->media_url ?>" <?= $selected ? 'checked' : '' ?>>
                  <div class="checkmark">
                    <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              Мы не нашли фото в вашем аккаунте...
            <?php endif; ?>

          </div>


        </div>
      </div>



      <div class="main-profile-btn-wrap">
        <button type="submit" class="btn main-profile-btn">Сохранить</button>
      </div>

    </form>

  </div>
</section>
