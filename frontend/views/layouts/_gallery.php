<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="gallery" id="gallery">

  <a href="#" class="gallery__close js-gallery-close">
    <svg _ngcontent-c54="" class="icon" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c54="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-width="2"><path _ngcontent-c54="" d="M8 8l16.986 16.986M19 14l6-6-6 6zM8 26l9-9"></path></g></svg>
  </a>

  <div class="gallery__content-wrap">
    <div class="gallery__content">

      <div class="gallery-container">
        <div class="gallery-image">

          <div class="gallery-control _left js-gallery-left _active">
            <div class="ico">
              <svg _ngcontent-c29="" class="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c29="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="square" stroke-width="2"><path _ngcontent-c29="" d="M12.378 23.788l8-8M17.33 12.901l-4.952-4.69"></path></g></svg>
            </div>
          </div>

          <div class="gallery-control _right js-gallery-right _active">
            <div class="ico">
              <svg _ngcontent-c29="" class="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c29="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="square" stroke-width="2"><path _ngcontent-c29="" d="M12.378 23.788l8-8M17.33 12.901l-4.952-4.69"></path></g></svg>
            </div>
          </div>

          <div class="gallery-preview">
            <img class="_image" src="" alt="">
          </div>

        </div>
        <div class="gallery-progress">
          <span><span class="_imagePosition"></span> из <span class="_imagesCount"></span></span>
        </div>
      </div>

      <div class="gallery-footer">
        <div class="gallery-info">
          <h3 class="gallery-info__name"><a href="#" class="_link _name" target="_blank"></a></h3>
          <span class="gallery-info__text _location"></span>
          <span class="gallery-info__text _price"></span>
        </div>
      </div>

    </div>
    <div class="gallery__content-right">
      <h3>Детали</h3>
      <div class="gallery-stats">
        <div class="gallery-stat-item">
          <h4>Рост</h4>
          <span class="_height"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Вес</h4>
          <span class="_weight"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Возраст</h4>
          <span class="_age"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Размер обуви</h4>
          <span class="_shoes"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Размер одежды</h4>
          <span class="_shirt"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Размер груди</h4>
          <span class="_bust"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Тип лица</h4>
          <span class="_ethnicity"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Цвет глаз</h4>
          <span class="_eyes"></span>
        </div>
        <div class="gallery-stat-item">
          <h4>Цвет волос</h4>
          <span class="_hair"></span>
        </div>
      </div>
    </div>
  </div>

</div>
