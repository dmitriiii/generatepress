// if (typeof checkMobile == 'function') {
//   // checkMobile();
//   console.log(checkMobile( true ));
// }

window.m5OpenInNewTab = function (redirect, currentUrl, $curr) {
  // Small popup function
  function manipulateSmallPopup(redirect) {
    var win2 = window.open(
      redirect,
      "_blank",
      "width=300,height=400,left=0,top=200,menubar=no,status=no",
      false
    );
    win2.blur();
    window.focus();
    setTimeout(function () {
      win2.close();
    }, 15000);
  }

  var type = $curr.closest(".pupop-wrapper").attr("data-type");

  //Usual popup's behavior
  if (type === "usual") {
    return;
  }

  //Check if mobile device or tablet similar behavior to all
  if (checkMobile(true)) {
    manipulateSmallPopup(redirect);
    return;
  }

  //full popup trick behavior
  if (type === "full") {
    var oldWin = window;
    var newWin = oldWin.open(currentUrl, "_blank");
    oldWin.location.href = redirect;
    return;
  }
  //small popup desktop
  manipulateSmallPopup(redirect);
};

jQuery(document).ready(function ($) {
  $(document.body).on("click", ".pupop__btn-close", function (e) {
    e.preventDefault();
    closePopup(this.closest(".pupop"));
    var $curr = $(this);
    m5OpenInNewTab($curr.attr("data-red"), $curr.attr("href"), $curr);
  });

  $(document.body).on("click", ".pupop__link", function (e) {
    e.preventDefault();

    const $wrapper = $(this).closest(".pupop-wrapper");
    $wrapper.trigger("popup:linkClick");

    closePopup($(this).siblings(".pupop"));
    var $curr = $(this);
    // var $pupop = $curr.closest('.pupop');
    m5OpenInNewTab($curr.attr("data-red"), $curr.attr("href"), $curr);
  });

  $(document.body).on("click", ".pupop__button", function () {
    const $wrapper = $(this).closest(".pupop-wrapper");
    $wrapper.trigger("popup:buttonClick");
    closePopup($(this).closest(".pupop"));
  });

  //overlay click
  $(document.body).on("click", ".pupop-wrapper", function (e) {
    const $wrapper = $(e.currentTarget);
    if ($wrapper.is(".pupop-wrapper")) return;
    $wrapper.trigger("popup:overlayClick");
    //closePopup($wrapper);
  });

  window.openPopup = function openPopup(pupopEl) {
    const $wrapper = $(pupopEl).closest(".pupop-wrapper");
    $wrapper.trigger("popup:beforeOpen");
    $wrapper.addClass("pupop-wrapper--showed");
    setTimeout(() => {
      $wrapper.addClass("pupop-wrapper--opened");
    }, 16);
    $wrapper.one("transitionend", function () {
      $wrapper.trigger("popup:open");
    });
    return $wrapper;
  };

  window.closePopup = function closePopup(pupopEl) {
    var $wrapper = $(pupopEl).closest(".pupop-wrapper");
    $wrapper.trigger("popup:beforeClose");
    $wrapper.one("transitionend", function () {
      $wrapper.removeClass("pupop-wrapper--showed");
      $wrapper.trigger("popup:close");
    });
    $wrapper.removeClass("pupop-wrapper--opened");
  };
});
