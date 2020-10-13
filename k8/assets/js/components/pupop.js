window.m5OpenInNewTab = function (redirect, currentUrl) {
  // var oldWin = window;
  // var newWin = oldWin.open( currentUrl, "_blank" );
  // oldWin.location.href = redirect;
  win2=window.open(redirect,"_blank","width=100,height=100,left=0,top=200,menubar=no,status=no",false);
  win2.blur();
  window.focus();
  setTimeout(function(){
    win2.close();
  }, 6000);
} 

jQuery(document).ready(function ($) {
  $(document.body).on("click", ".pupop__btn-close", function (e) {
    e.preventDefault();
    closePopup(this.closest(".pupop"));
    m5OpenInNewTab( $(this).attr('data-red'), $(this).attr('href') );
  });

  $(document.body).on("click", ".pupop__link", function (e) {
    e.preventDefault();
    closePopup($(this).siblings(".pupop"));
    m5OpenInNewTab( $(this).attr('data-red'), $(this).attr('href') );
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