function GalleryScripts() {
  const $gallery = $('#gallery');
  const $name = $gallery.find('._name');
  const $image = $gallery.find('._image');
  const $imagePosition = $gallery.find('._imagePosition');
  const $imagesCount = $gallery.find('._imagesCount');
  const $location = $gallery.find('._location');
  const $price = $gallery.find('._price');
  const $link = $gallery.find('._link');

  const $height = $gallery.find('._height');
  const $weight = $gallery.find('._weight');
  const $age = $gallery.find('._age');
  const $shoes = $gallery.find('._shoes');
  const $shirt = $gallery.find('._shirt');
  const $bust = $gallery.find('._bust');
  const $ethnicity = $gallery.find('._ethnicity');
  const $eyes = $gallery.find('._eyes');
  const $hair = $gallery.find('._hair');

  let galleryCount = 0;
  let galleryPosition = 0;

  $('.js-open-gallery').on('click', function(e) {
    e.preventDefault();
    const forD = $(this).data('for');
    const position = $(this).data('position');
    const $meta = $('.gallery-meta[data-for="'+forD+'"]');
    const $metaImage = $meta.find('.meta-images div[data-position="'+position+'"]');

    $gallery.attr('data-for', forD);


    if ($meta.data('only-image') == '1') {
      $gallery.find('.gallery-footer').hide();
      $gallery.find('.gallery__content-right').html('');
    }


    $name.text( $meta.find('._name').text() );
    $location.text( $meta.find('._location').text() );
    $price.text( $meta.find('._price').text() );

    $image.attr('src', $metaImage.data('src'));
    $imagePosition.text( Number($metaImage.data('position')) + 1 );
    $imagesCount.text( $meta.find('._imagesCount').text() );

    galleryCount = Number($meta.find('._imagesCount').text());
    galleryPosition = Number($metaImage.data('position')) + 1;

    $link.attr('href', '/model/' + $meta.find('._id').text());


    if ($meta.find('._height').text() == '') {
      $('.gallery__content-right').css({'opacity': 0});
    }

    $height.text( $meta.find('._height').text() );
    $weight.text( $meta.find('._weight').text() );
    $age.text( $meta.find('._age').text() );
    $shoes.text( $meta.find('._shoes').text() );
    $shirt.text( $meta.find('._shirt').text() );
    $bust.text( $meta.find('._bust').text() );
    $ethnicity.text( $meta.find('._ethnicity').text() );
    $eyes.text( $meta.find('._eyes').text() );
    $hair.text( $meta.find('._hair').text() );


    // $gallery.show();
    showGallery();
    return false;
  });


  $('.js-gallery-right').on('click', function(e) {
    e.preventDefault();
    const forD = $gallery.attr('data-for');
    const $meta = $('.gallery-meta[data-for="'+forD+'"]');

    galleryPosition++;
    if (galleryPosition > galleryCount) {
      galleryPosition = 1;
    }

    console.log($meta);

    $image.attr('src', $meta.find('.meta-images div[data-position="'+(galleryPosition-1)+'"]').data('src'));
    $imagePosition.text( galleryPosition );

    return false;
  });

  $('.js-gallery-left').on('click', function(e) {
    e.preventDefault();
    const forD = $gallery.attr('data-for');
    const $meta = $('.gallery-meta[data-for="'+forD+'"]');

    galleryPosition--;
    if (galleryPosition < 1) {
      galleryPosition = galleryCount;
    }

    $image.attr('src', $meta.find('.meta-images div[data-position="'+(galleryPosition-1)+'"]').data('src'));
    $imagePosition.text( galleryPosition );

    return false;
  });






  $('.js-gallery-close').on('click', function(e) {
    e.preventDefault();
    // $gallery.hide();
    closeGallery();
    return false;
  });

}


function showGallery() {
  $('#gallery').addClass('_open')
}
function closeGallery() {
  $('#gallery').removeClass('_open')
}
