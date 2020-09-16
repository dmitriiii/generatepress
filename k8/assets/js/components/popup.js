window.m5OpenInNewTab = function (url) {
  win2=window.open(url,"_blank","width=100,height=100,left=0,top=0,menubar=no,status=no",false);
  win2.blur();
  window.focus();
  setTimeout(function(){
    win2.close();
  }, 4000);
}

jQuery(document).ready(function ($) {
  $(document.body).on("click", ".popup__btn-close", function (e) {
    e.preventDefault();
    closePopup(this.closest(".popup"));
    m5OpenInNewTab( $(this).attr('href') );
  });

  $(document.body).on("click", ".popup__link", function (e) {
    e.preventDefault();
    closePopup($(this).siblings(".popup"));
    m5OpenInNewTab( $(this).attr('href') );
  });

  $(document.body).on("click", ".popup__button", function () {
    closePopup($(this).closest(".popup"));
  });


  window.openPopup = function openPopup(popupEl) {
    $(popupEl).closest(".popup-wrapper").addClass("popup-wrapper--showed");
    setTimeout(function () {
      $(popupEl).closest(".popup-wrapper").addClass("popup-wrapper--opened");
    }, 16);
  }

  window.closePopup = function closePopup(popupEl) {
    var $popupWrapper = $(popupEl).closest(".popup-wrapper");
    $popupWrapper.one("transitionend", function () {
      $popupWrapper.removeClass("popup-wrapper--showed");
    });
    $popupWrapper.removeClass("popup-wrapper--opened");
  }
})
