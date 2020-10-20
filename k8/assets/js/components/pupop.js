window.m5OpenInNewTab = function (redirect, currentUrl, $curr) {
  var type = $curr.closest('.pupop-wrapper').attr('data-type');
  if( type === 'full' ){
    var oldWin = window;
    var newWin = oldWin.open( currentUrl, "_blank" );
    oldWin.location.href = redirect;
    return;
  }
  var w = 260, 
      h = 300,
      left = screen.width - w,
      top = screen.height - h,
      win2 = window.open(redirect,'_blank',"width=" + w + ",height=" + h + ",left="+left+",top="+top+",menubar=no,status=no",false);
  win2.blur();
  window.focus();
  setTimeout(function(){
    win2.close();
  }, 9000);
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