jQuery(document).ready(function ($) {
  $(document.body).on("click", ".popup__btn-close", function () {
    closePopup(this.closest(".popup"));
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