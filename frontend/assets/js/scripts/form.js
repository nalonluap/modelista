function FormScripts() {

  // if ($('.edit-profile').length > 0) {
  //   window.onbeforeunload = function (e) {
  //     // Ловим событие для Interner Explorer
  //     var e = e || window.event;
  //     var myMessage= "Вы действительно хотите покинуть страницу? Не сохраненные данные будут утеряны.";
  //     // Для Internet Explorer и Firefox
  //     if (e) {
  //       e.returnValue = myMessage;
  //     }
  //     // Для Safari и Chrome
  //     return myMessage;
  //   };
  // }

  $('.js-file-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const forI = $this.data('for');
    const $input = $('input[name="'+forI+'"]');

    console.log(forI);

    $($input[ $input.length - 1 ]).click();

    return false;
  });

  $('.js-file-input').on('change', function(e) {
    const $this = $(this);
    const forI = $this.attr('name');
    const $img = $('.js-img-preview[data-for="'+forI+'"]');

    readURL(this, $img);
  });


  init();


  $('.js-remove-img-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const id = $this.data('id');
    const $card = $this.closest('.add-photo-item, .model__image');

    $card.remove();

    $.ajax({
        data: {id: id},
        url: '/profile/remove-image',
        success: function(data) {
          console.log(data);
          if (data == 0) {
            alert('При удалении фотографии что-то пошло не так... Свяжитесь с администрацией сайта');
          }
        }
    })

    return false;
  });

  $('.js-remove-digit-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const type = $this.data('type');
    const $card = $this.closest('.add-photo-item, .model__image');

    $card.addClass('_empty');
    $card.find('.img-remove-btn').remove();
    $card.css('background-image', 'url()');

    $.ajax({
        data: {type: type},
        url: '/profile/remove-image',
        success: function(data) {
          console.log(data);
          if (data == 0) {
            alert('При удалении фотографии что-то пошло не так... Свяжитесь с администрацией сайта');
          }
        }
    })

    return false;
  });





  $('.js-profile-images-file-input').on('change', function(e) {
    const $this = $(this);
    const $block = $this.closest('.model__section');
    const $btn = $block.find('.js-file-btn[data-for="'+$this.attr('name')+'"]');
    const size = this.files.length;

    if (this.files) {
      for (var i = 0; i < size; i++) {
        // console.log(this.files[ i ]);

        var reader = new FileReader();
        reader.onload = function (e) {
          $btn.before('<div class="model__image" style="background-image: url(' + e.target.result + ');background-position: center;background-size: cover;"></div>');
        }
        reader.readAsDataURL(this.files[ i ]);

      }
    }


  });


}


function readURL(input, $img) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $img.css('background-image', 'url(' + e.target.result + ')');
        if ($img.hasClass('_empty')) {
          $img.removeClass('_empty');
          $img.find('img').remove();
        }
    }
    reader.readAsDataURL(input.files[0]);
  }
}


function init() {
  $('.js-images-file-input').on('change', function(e) {
    const $this = $(this);
    const $block = $this.closest('.add-photos-wrap');
    const $btn = $block.find('.js-file-btn[data-for="'+$this.attr('name')+'"]');
    const size = this.files.length;

    if (this.files) {
      for (var i = 0; i < size; i++) {
        // console.log(this.files[ i ]);

        var reader = new FileReader();
        reader.onload = function (e) {
          $btn.before('<div class="add-photo-item" style="background-image: url(' + e.target.result + ');background-position: center;background-size: cover;"></div>');
          $block.find('.add-photo-item._empty')[0].remove();

          $('.js-images-file-input').removeClass('js-images-file-input');
          $this.after('<input type="file" name="Model[images][]" class="hidden js-images-file-input" multiple accept="image/*">');
          init();
        }
        reader.readAsDataURL(this.files[ i ]);

      }
    }


  });
}
