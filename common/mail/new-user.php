<?php
use yii\helpers\Html;
use common\models\User;
?>
<?php if ($user->type == User::TYPE_MODEL): ?>
  Новая модель <?= $user->name ?> <?= $user->surname ?>
  <br>
  <a href="https://modelista.ru/model/<?= $user->entity->id ?>?check">Ссылка</a>
<?php else: ?>
  Новый фотограф <?= $user->name ?> <?= $user->surname ?>
  <br>
  <a href="https://modelista.ru/photographer/<?= $user->entity->id ?>?check">Ссылка</a>
<?php endif; ?>
