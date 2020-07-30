jQuery(document).ready(function($) {
  let popup = document.getElementById("sales");
  if (!popup) return;
  let delay = popup.dataset.delay ? +popup.dataset.delay : 0
  let cSpe = parseInt(Cookie.get("_sale_modal"))
  let dSpe = parseInt(popup.dataset.times)
  let spe = (isNaN(cSpe) ? 1 : cSpe) || dSpe || 1;
  Cookie.set("_sale_modal", --spe, {
    samesite: "strict",
    "max-age": secToTomorrow(),
  });
  if (!spe && isNotExpTimer()) setTimeout(function() {openPopup($("#sales"));}, delay) 

  function isNotExpTimer() {
    let timerEl = popup.querySelector('.timer')
    if (!timerEl) return true;
    return (new Date(timerEl.dataset.date)).getTime() - Date.now() > 0 ? true : false;
  }
  function secToTomorrow() {
    let now = new Date();
    let tomorrow = new Date(Date.now() + 86400e3);
    tomorrow.setHours(0, 0, 0, 0)
    return Math.round((tomorrow - now) / 1000);
  }
})