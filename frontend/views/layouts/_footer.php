<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="main-footer">

    <div class="wrap">
      <!-- <div class="footer-item">
        <h3>Заголовок</h3>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
      </div>

      <div class="footer-item">
        <h3>Заголовок</h3>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
      </div>

      <div class="footer-item">
        <h3>Заголовок</h3>
        <a href="#">Link</a>
        <a href="#">Link</a>
        <a href="#">Link</a>
      </div>

      <div class="footer-item">
        <h3>Заголовок</h3>
        <a href="#">Link</a>
        <a href="#">Link</a>
      </div> -->
    </div>

    <div class="main-footer__bottom">
      <span>2021 © Modelista Inc.</span>
      <span>All Rights Reserved</span>
    </div>
    <?= $this->render('_social-list') ?>

</footer>
