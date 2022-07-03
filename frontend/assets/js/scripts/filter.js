function FilterScripts() {

  $('.js-search-input').on('focus', function(e) {
    const $form = $(this).closest('form');
    $form.addClass('_active');
  });
  $('.js-search-input').on('blur', function(e) {
    const $form = $(this).closest('form');
    $form.removeClass('_active');
  });

  $('.js-open-filter-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $filter = $('.js-filter');

    $filter.show();

    return false;
  });

  $('.js-filter-close-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $filter = $('.js-filter');

    $filter.hide();

    return false;
  });

}
