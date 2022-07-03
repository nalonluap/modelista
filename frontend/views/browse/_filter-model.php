<?php
use common\models\Data;
?>

<div class="filter-row">
  <a href="#" class="open-filter-btn js-open-filter-btn">
    <span class="ico"><svg _ngcontent-c23="" class="icon" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c23="" fill="none" fill-rule="nonzero"><path _ngcontent-c23="" d="M0 0h22v22H0z"></path><path _ngcontent-c23="" d="M11 10H0v2h11zM22 10h-1v2h1zM13 9h6v4h-6zM0 4h3V2H0zM13 4h9V2h-9zM5 1h6v4H5zM22 18H12v2h10zM2 18H0v2h2zM4 17h6v4H4z" fill="currentColor"></path></g></svg></span>
    <span class="text">Фильтры</span>
  </a>
  <form class="filter-search-form" action="/browse" method="get">
    <div class="ico">
      <svg _ngcontent-c23="" class="icon" height="18" viewBox="0 0 18 18" width="18" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-c23="" d="M13 13l4.263 4.263" stroke="currentColor" stroke-width="2"></path><path _ngcontent-c23="" d="M9.552 13.797a6 6 0 1 1 1.923-.905l1.429 1.43a8 8 0 1 0-1.782 1.047l-1.57-1.572z" fill="currentColor"></path></svg>
    </div>
    <input type="text" class="js-search-input" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Поиск по имени модели">
  </form>
</div>


<div class="filter js-filter">

  <a href="#" class="filter__close js-filter-close-btn">
    <svg _ngcontent-c54="" class="icon" height="32" width="32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c54="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-width="2"><path _ngcontent-c54="" d="M8 8l16.986 16.986M19 14l6-6-6 6zM8 26l9-9"></path></g></svg>
  </a>

  <form class="filter__form" action="/browse" method="get">

    <h2>Фильтр</h2>
    <h3 class="subtitle">Категории</h3>

    <div class="buttons">
      <?php foreach (Data::CATEGORIES as $key => $cat): ?>
        <div class="checkbox-button">
          <input type="radio" id="category-<?= $key ?>" name="categoryId" value="<?= $key ?>" <?= (isset($_GET['categoryId']) AND $_GET['categoryId'] == $key) ? 'checked' : '' ?>>
          <label for="category-<?= $key ?>">
            <span><?= $cat['title'] ?></span>
          </label>
        </div>
      <?php endforeach; ?>
    </div>

    <h3 class="subtitle">Популярные фильтры</h3>

    <div class="row">

      <div class="column">

        <header>
          <div class="filter-name">Пол</div>
        </header>

        <div class="control">

          <?php foreach (Data::GENDER as $key => $value): ?>
            <div class="check-row">
              <input type="checkbox"
                 id="gender-<?= $key ?>"
                 name="gender[]"
                 value="<?= $key ?>"
                 <?= (isset($_GET['gender']) AND in_array($key, $_GET['gender'])) ? 'checked' : '' ?>
               >
              <label for="gender-<?= $key ?>">
                <div class="checkmark">
                  <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                </div>
                <span><?= $value ?></span>
              </label>
            </div>
          <?php endforeach; ?>
        </div>


      </div>

      <div class="column">
        <header>
          <div class="filter-name">Город</div>
        </header>
        <div class="control">
          <select name="city">
            <option value="any">Любой</option>
            <?php foreach (Data::CITIES as $key => $value): ?>
              <option value="<?= $key ?>"  <?= (isset($_GET['city']) AND $_GET['city'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="column">

        <header>
          <div class="filter-name">TFP</div>
        </header>
        <div class="control">
          <?php foreach (['Нет', 'Да'] as $key => $value): ?>
            <div class="check-row">
              <input type="checkbox"
                 id="tfp-<?= $key ?>"
                 name="tfp[]"
                 value="<?= $key ?>"
                 <?= (isset($_GET['tfp']) AND in_array($key, $_GET['tfp'])) ? 'checked' : '' ?>
               >
              <label for="tfp-<?= $key ?>">
                <div class="checkmark">
                  <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                </div>
                <span><?= $value ?></span>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
        <br><br>

        <header>
          <div class="filter-name">Стоимость часа</div>
        </header>
        <div class="control">
          <div class="range-row">
            <div class="range-col">
              <input type="number" name="hourPrice[min]" value="<?= isset($_GET['hourPrice']['min']) ? $_GET['hourPrice']['min'] : '' ?>" placeholder="От">
            </div>
            <div class="range-col">
              <input type="number" name="hourPrice[max]" value="<?= isset($_GET['hourPrice']['max']) ? $_GET['hourPrice']['max'] : '' ?>" placeholder="До">
            </div>
          </div>
        </div>
      </div>

    </div>

    <hr class="hr">


    <div class="row">

      <div class="column">
        <h3 class="section-title">Показания</h3>




        <div class="column__item">
          <header>
            <div class="filter-name">Рост</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="height[min]" value="<?= isset($_GET['height']['min']) ? $_GET['height']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="height[max]" value="<?= isset($_GET['height']['max']) ? $_GET['height']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Вес</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="weight[min]" value="<?= isset($_GET['weight']['min']) ? $_GET['weight']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="weight[max]" value="<?= isset($_GET['weight']['max']) ? $_GET['weight']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Размер одежды</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="shirt[min]" value="<?= isset($_GET['shirt']['min']) ? $_GET['shirt']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="shirt[max]" value="<?= isset($_GET['shirt']['max']) ? $_GET['shirt']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Размер обуви</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="shoes[min]" value="<?= isset($_GET['shoes']['min']) ? $_GET['shoes']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="shoes[max]" value="<?= isset($_GET['shoes']['max']) ? $_GET['shoes']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Размер груди</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="bust[min]" value="<?= isset($_GET['bust']['min']) ? $_GET['bust']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="bust[max]" value="<?= isset($_GET['bust']['max']) ? $_GET['bust']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>




      </div>

      <div class="column">
        <h3 class="section-title">Внешний вид</h3>


        <div class="column__item">
          <header>
            <div class="filter-name">Возраст</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="age[min]" value="<?= isset($_GET['age']['min']) ? $_GET['age']['min'] : '' ?>" placeholder="От">
              </div>
              <div class="range-col">
                <input type="number" name="age[max]" value="<?= isset($_GET['age']['max']) ? $_GET['age']['max'] : '' ?>" placeholder="До">
              </div>
            </div>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Тип лица</div>
          </header>

          <div class="control">

            <?php foreach (Data::ETHNICITY as $key => $value): ?>
              <div class="check-row">
                <input type="checkbox"
                    id="ethnicity-<?= $key ?>"
                    name="ethnicity[]"
                    value="<?= $key ?>"
                    <?= (isset($_GET['ethnicity']) AND in_array($key, $_GET['ethnicity'])) ? 'checked' : '' ?>
                >
                <label for="ethnicity-<?= $key ?>">
                  <div class="checkmark">
                    <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                  </div>
                  <span><?= $value ?></span>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>


        <div class="column__item">
          <header>
            <div class="filter-name">Цвет глаз</div>
          </header>

          <div class="control">

            <?php foreach (Data::EYES as $key => $value): ?>
              <div class="check-row">
                <input type="checkbox"
                    id="eye-<?= $key ?>"
                    name="eye[]"
                    value="<?= $key ?>"
                    <?= (isset($_GET['eye']) AND in_array($key, $_GET['eye'])) ? 'checked' : '' ?>
                >
                <label for="eye-<?= $key ?>">
                  <div class="checkmark">
                    <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                  </div>
                  <span><?= $value ?></span>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Цвет волос</div>
          </header>

          <div class="control">

            <?php foreach (Data::HAIR as $key => $value): ?>
              <div class="check-row">
                <input type="checkbox"
                    id="hair-<?= $key ?>"
                    name="hair[]"
                    value="<?= $key ?>"
                    <?= (isset($_GET['hair']) AND in_array($key, $_GET['hair'])) ? 'checked' : '' ?>
                >
                <label for="hair-<?= $key ?>">
                  <div class="checkmark">
                    <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                  </div>
                  <span><?= $value ?></span>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="column__item">
          <header>
            <div class="filter-name">Татуировки</div>
          </header>

          <div class="control">

            <?php foreach (Data::TATTOO as $key => $value): ?>
              <div class="check-row">
                <input type="checkbox"
                    id="tattoo-<?= $key ?>"
                    name="tattoo[]"
                    value="<?= $key ?>"
                    <?= (isset($_GET['tattoo']) AND in_array($key, $_GET['tattoo'])) ? 'checked' : '' ?>
                >
                <label for="tattoo-<?= $key ?>">
                  <div class="checkmark">
                    <svg class="icon-unchecked" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M.5.5h11v11H.5z" stroke="currentColor"></path></g></svg><svg _ngcontent-c51="" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-checked" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c51="" fill="none" fill-rule="evenodd"><path _ngcontent-c51="" d="M5 9.5l-.354.354.388.387.35-.42L5 9.5zM2.646 7.854l2 2 .708-.708-2-2-.708.708zM5.384 9.82l7.5-9-.768-.64-7.5 9 .768.64z" fill="currentColor" fill-rule="nonzero"></path><path _ngcontent-c51="" d="M11 6.037V12H1V2h7.132l.834-1H0v12h12V4.837l-1 1.2zM12 1v.762l-1 1.2V2h-.338l.833-1H12z" fill="currentColor" fill-rule="nonzero"></path></g></svg>
                  </div>
                  <span><?= $value ?></span>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>



      </div>

      <div class="column">
        <h3 class="section-title">Социализация</h3>

        <div class="column__item">
          <header>
            <div class="filter-name">Подписчики</div>
          </header>
          <div class="control">
            <div class="range-row">
              <div class="range-col">
                <input type="number" name="" value="" placeholder="От" disabled>
              </div>
              <div class="range-col">
                <input type="number" name="" value="" placeholder="До" disabled>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>


    <div class="form__actions">
      <div class="container">
        <a href="/browse" class="btn clear-btn">Очистить</a>
        <button type="submit" class="btn">Применить</button>
      </div>
    </div>

  </form>

</div>
