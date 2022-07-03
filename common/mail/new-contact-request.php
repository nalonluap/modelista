<?php
use yii\helpers\Html;
?>

<a href="https://modelista.ru/<?= ($senderType == 0) ? 'model' : (($senderType == 1) ? 'photographer' : 'model') ?>/<?= $sender->entity->id ?>" target="_blank"><?= $sender->name ?> <?= $sender->surname ?></a> оставил(a) запрос на предоставление ваших контактных данных
<br>
<a href="https://modelista.ru/">Modelista</a>
