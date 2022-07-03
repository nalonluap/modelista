/* eslint-disable no-undef */
$(document).ready(() => {

  svg4everybody();
  sliders();
  FormScripts();
  GalleryScripts();



  // $('.js-instagram-followers').each(function(index, element) {
  //   let $this = $(this);
  //   let id = $this.data('id');
  //   let instagram = $this.data('instagram');
  //
  //   $.ajax({
  //       data: {instagram: instagram},
  //       url: '/instagram/get',
  //       success: function(data) {
  //         if (data.status) {
  //           if (!empty(data.followers)) {
  //             $this.text(numberWithCommas(data.followers));
  //           }
  //         }
  //       }
  //   })
  // });

  if (typeof favoriteModelIds !== 'undefined'){
    if (favoriteModelIds instanceof Array){
        let indexC;
        for (indexC = 0; indexC < favoriteModelIds.length; ++indexC) {
            let button = $('.js-favorite-btn[data-id="'+favoriteModelIds[indexC]+'"][data-type="0"]');
            button.addClass('_active');
        }
    }
  }

  if (typeof favoritePhotographerIds !== 'undefined'){
    if (favoritePhotographerIds instanceof Array){
        let indexC;
        for (indexC = 0; indexC < favoritePhotographerIds.length; ++indexC) {
            let button = $('.js-favorite-btn[data-id="'+favoritePhotographerIds[indexC]+'"][data-type="1"]');
            button.addClass('_active');
        }
    }
  }


  // if ($('.index').length > 0) {
    $('.js-nav-scroll').on('click', function(e) {
      e.preventDefault();
      const $this = $(this);
      const id = $this.attr('href');
      let offset = 100;
      if (typeof($this.data('offset')) != "undefined") {
        offset = $this.data('offset');
      }

      if($('.js-menu').hasClass('_open')) {
        hideMenu();
      }

      scrollToDiv($(id), offset)

      return false;
    });
  // }


  if ($('#scrollTo').length > 0) {
    setTimeout(function() {
      scrollToDiv($( '#' + $('#scrollTo').val() ), $('#scrollTo').data('offset'))
    }, 1000);
  }


  if ($('.auth').length > 0) {
    AuthScripts();
  }

  if ($('.filter').length > 0) {
    FilterScripts();
  }


  $('.js-menu').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $menu = $('.js-main-menu');

    if($this.hasClass('_open')) {
      hideMenu();
    } else {
      $this.addClass('_open');
      $menu.show();
    }

    return false;
  });


  $('.js-show-notification-center').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $nCenter = $('.notification-center');

    if($nCenter.hasClass('_open')) {
      $nCenter.removeClass('_open');
    } else {
      $nCenter.addClass('_open');
    }

    return false;
  });

  $('.js-notification-center-close').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $nCenter = $('.notification-center');
    $nCenter.removeClass('_open');
    return false;
  });


  $('body').on('click', function(e) {
    if($('.js-menu').hasClass('_open')) {
      hideMenu();
    }

    if($('.notification-center').hasClass('_open')) {
      if ($(e.target).closest('.notification-center').length < 1) {
        $('.notification-center').removeClass('_open');
      }
    }

  });


  if($('#gallery').length > 0) {
    $('#gallery').addClass('_transition');
  }

  $(document).keyup(function(e) {
    if (e.key === "Escape") {
      $('.js-filter').hide();
      closeGallery();
    }
  });



  $('.js-favorite-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const id = $this.data('id');
    const type = $this.data('type');

    if($this.hasClass('_active')) {
      $this.removeClass('_active')
    } else {
      $this.addClass('_active')
    }

    $.ajax({
        data: {id: id, type: type},
        url: '/favorite/add',
        success: function(data) {
          console.log(data);
          if (data == 3) {
            window.location = '/auth';
          }
          if (data == 0) {
            alert('При изменении избранного что-то пошло не так... Свяжитесь с администрацией сайта');
          }

          if ($('.favorite-page').length > 0) {
            // location.reload();
            $this.closest('.small-item').remove();
          }

        }
    })
    return false;
  });


  $('.js-show-contact').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const id = $this.data('id');
    const type = $this.data('type');

    const text = $this.text();

    $this.text('Заргрузка...');

    $.ajax({
        data: {id: id, type: type},
        url: '/model/get-contacts',
        success: function(data) {
          console.log(data);
          if (data.status == 'unauthorized') {
            window.location = '/auth';
          } else if (data.status == 0) {
            alert('Что-то пошло не так... Свяжитесь с администрацией сайта');
          } else if (data.status == 1) {
            $('.modal-container__content').html(data.render);
            $('.modal').addClass('_open');
            $this.text(text);
            initSendRequestBtn();
          }
        }
    })
    return false;
  });


  if ($('.favorite-page').length > 0) {
    $('.slick-prev, .slick-next').html('<svg _ngcontent-c29="" class="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g _ngcontent-c29="" fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="square" stroke-width="2"><path _ngcontent-c29="" d="M12.378 23.788l8-8M17.33 12.901l-4.952-4.69"></path></g></svg>');
  }

  $('.js-close-modal').on('click', function(e) {
    e.preventDefault();
    $('.modal').removeClass('_open');
    return false;
  });





  $('.js-notification-contact-btn').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const id = $this.data('id');
    let type = 'accept';

    if ($this.hasClass('_deny')) {
      type = 'deny';
    }

    const text = $this.text();

    $this.text('Заргрузка...');

    console.log({id: id, type: type});

    $.ajax({
        data: {id: id, type: type},
        url: '/model/set-notification',
        success: function(data) {
          console.log(data);
          if (data.status == 0) {
            alert(data.msg);
            $this.text(text);
          } else if (data.status == 1) {
            if (type == 'deny') {
              $this.text('Отклонено');
            } else {
              $this.text('Принято');
            }
          }
        }
    })
    return false;
  });



  $('.js-write-btn').on('click', function(e) {
    e.preventDefault();
    alert('Эта функция временно недоступна! ;(');
    return false;
  });






  $('.js-instagram-connect').on('click', function(e) {
    e.preventDefault();
    const $form = $(this).closest('form');
    $form.append('<input type="hidden" name="connect-instagram" value="1">');
    $form.submit();
    return false;
  });

  $('.js-instagram-img').on('click', function(e) {
    e.preventDefault();
    const $checkbox = $(this).find('input[type="checkbox"]');
    $checkbox.prop('checked', !$checkbox.prop('checked'));
    $(this).toggleClass('_selected');
    return false;
  });



});

function hideMenu() {
  $('.js-menu').removeClass('_open');
  $('.js-main-menu').hide();
}


function initSendRequestBtn() {
  $('.js-send-request').on('click', function(e) {
    e.preventDefault();
    const $this = $(this);
    const id = $this.data('id');

    $this.text('Заргрузка...');

    $.ajax({
        data: {id: id},
        url: '/model/send-request',
        success: function(data) {
          console.log(data);
          if (data.status == 0) {
            alert(data.msg);
            $('.modal').removeClass('_open');
          } else if (data.status == 1) {

            $('.modal-container__content').html(data.render);
            // $('.modal').addClass('_open');

          }
        }
    })
    return false;
  });
}
