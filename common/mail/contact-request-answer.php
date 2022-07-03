<?php
use yii\helpers\Html;
?>

<?php if ($type == 'accept'): ?>
  <a href="https://modelista.ru/<?= ($senderType == 0) ? 'model' : (($senderType == 1) ? 'photographer' : 'model') ?>/<?= $sender->entity->id ?>" target="_blank"><?= $sender->name ?> <?= $sender->surname ?></a> принял(a) ваш запрос на предоставление контактных данных
<?php else: ?>
  <a href="https://modelista.ru/<?= ($senderType == 0) ? 'model' : (($senderType == 1) ? 'photographer' : 'model') ?>/<?= $sender->entity->id ?>" target="_blank"><?= $sender->name ?> <?= $sender->surname ?></a> отклонил(a) ваш запрос на предоставление контактных данных
<?php endif; ?>

<br>
<a href="https://modelista.ru/">Modelista</a>
