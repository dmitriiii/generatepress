jQuery(document).ready(function($) {
  let pupop = document.getElementById("sales");
  if (!pupop) return;
  let delay = pupop.dataset.delay ? +pupop.dataset.delay : 0
  let cSpe = parseInt(Cookie.get("_sale_modal"))
  let dSpe = parseInt(pupop.dataset.times)
  let spe = (isNaN(cSpe) ? 1 : cSpe) || dSpe || 1;

  Cookie.set("_sale_modal", --spe, {
    samesite: "strict",
    "max-age": secToTomorrow(),
  });
  if (!spe && isNotExpTimer()) setTimeout(function() {openPopup($("#sales"));}, delay) 

  function isNotExpTimer() {
    let timerEl = pupop.querySelector('.timer')
    if (!timerEl) return true;
    let currentDate = new Date(timerEl.dataset.date.replace(/-/g, "/"));
    return currentDate.getTime() - Date.now() > 0 ? true : false;
  }
  function secToTomorrow() {
    let now = new Date();
    let tomorrow = new Date(Date.now() + 86400e3);
    tomorrow.setHours(0, 0, 0, 0)
    return Math.round((tomorrow - now) / 1000);
  }
})