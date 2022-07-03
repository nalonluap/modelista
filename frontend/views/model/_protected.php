<div class="protected">
  <div class="wrap">
    <h3>Защищенная инфомация</h3>
    <?php if (Yii::$app->user->isGuest): ?>
      <p>Эти данные могут просматривать только зарегистрированные пользователи.</p>
      <br>
      <a href="/auth" class="btn">Войти</a>
    <?php else: ?>
      <p>Ваш аккаунт ожидает подтверждения нашей командой. Если вам нужно ускорить процесс рассмотрения, напишите нам по адресу <a href="mailto:hq@modelista.ru">hq@modelista.ru</a></p>
    <?php endif; ?>
  </div>
</div>
