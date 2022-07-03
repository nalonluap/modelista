function hasScrollbar($elem) {
    if($elem.length < 1) return;
    return $elem[0].scrollHeight > $elem.height();
}


// disable scroll on safari
const $body = document.querySelector('body');
let scrollPosition = 0;

function disableScroll(withTop = true) {
    scrollPosition = window.pageYOffset;
    $body.style.overflow = 'hidden';
    $body.style.position = 'fixed';
    if(withTop) {
      $body.style.top = `-${scrollPosition}px`;
    }
    $body.style.width = '100%';
}

function enableScroll() {
    $body.style.removeProperty('overflow');
    $body.style.removeProperty('position');
    $body.style.removeProperty('top');
    $body.style.removeProperty('width');
    if (scrollPosition != 0) {
      window.scrollTo(0, scrollPosition);
    }
}

function declination(number, titles) {
  const cases = [2, 0, 1, 1, 1, 2];
  return titles[ (number%100>4 && number%100<20)? 2:cases[(number%10<5)?number%10:5] ];
}

function formatPrice(price) {
   return (Math.round(price) + "").replace(/(\d)(?=(\d\d\d)+$)/, "$1 ") + ' руб.';
}


function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}

function supports_history_api() {
    return !!(window.history && history.pushState);
}

function is_object( mixed_var ) {
    return ( mixed_var instanceof Object );
}
function is_array( mixed_var ) {
    return ( mixed_var instanceof Array );
}
function empty( mixed_var ) {	// Determine whether a variable is empty
    //
    // +   original by: Philippe Baumann

    return ( mixed_var === "" || mixed_var === 0   || mixed_var === "0" || mixed_var === null  || mixed_var === false  ||  ( is_array(mixed_var) && mixed_var.length === 0 ) );
}

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

function scrollToDiv(element, navHeight) {
    var offset = element.offset();
    var offsetTop = offset.top;
    var totalScroll = offsetTop - navHeight;

    $('body,html').animate({
        scrollTop: totalScroll
    }, 500);
}
function jumpTo(anchor) {
    document.getElementById(anchor).scrollIntoView();
    return false;
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
