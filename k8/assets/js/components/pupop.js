

// if (typeof checkMobile == 'function') {
//   // checkMobile();
//   console.log(checkMobile( true ));
// }

window.m5OpenInNewTab = function (redirect, currentUrl, $curr) {

  // Small popup function
  function manipulateSmallPopup(redirect){
    var win2=window.open(redirect,"_blank","width=300,height=400,left=0,top=200,menubar=no,status=no",false);
    win2.blur();
    window.focus();
    setTimeout(function(){
      win2.close();
    }, 9000);
  }

  var type = $curr.closest('.pupop-wrapper').attr('data-type');

   //Usual popup's behavior
  if( type === 'usual' ){
    return;
  }

  //Check if mobile device or tablet similar behavior to all
  if( checkMobile(true) ){
    manipulateSmallPopup(redirect);
    return;
  }

  //full popup trick behavior
  if( type === 'full' ){
    var oldWin = window;
    var newWin = oldWin.open( currentUrl, "_blank" );
    oldWin.location.href = redirect;
    return;
  }
  //small popup desktop
  manipulateSmallPopup(redirect);
}

jQuery(document).ready(function ($) {
  $(document.body).on("click", ".pupop__btn-close", function (e) {
    e.preventDefault();
    closePopup(this.closest(".pupop"));
    var $curr = $(this);
    m5OpenInNewTab( $curr.attr('data-red'), $curr.attr('href'), $curr );
  });

  $(document.body).on("click", ".pupop__link", function (e) {
    e.preventDefault();
    closePopup($(this).siblings(".pupop"));
    var $curr = $(this);
    // var $pupop = $curr.closest('.pupop');
    m5OpenInNewTab( $curr.attr('data-red'), $curr.attr('href'), $curr );
  });

  $(document.body).on("click", ".pupop__button", function () {
    closePopup($(this).closest(".pupop"));
  });


  window.openPopup = function openPopup(pupopEl) {
    $(pupopEl).closest(".pupop-wrapper").addClass("pupop-wrapper--showed");
    setTimeout(function () {
      $(pupopEl).closest(".pupop-wrapper").addClass("pupop-wrapper--opened");
    }, 2000);
  }

  window.closePopup = function closePopup(pupopEl) {
    var $pupopWrapper = $(pupopEl).closest(".pupop-wrapper");
    $pupopWrapper.one("transitionend", function () {
      $pupopWrapper.removeClass("pupop-wrapper--showed");
    });
    $pupopWrapper.removeClass("pupop-wrapper--opened");
  }
})