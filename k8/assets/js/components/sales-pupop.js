jQuery(document).ready(function ($) {
  let pupop = document.getElementById("sales");
  let popupWrapper = pupop.closest(".pupop-wrapper");
  let id = popupWrapper.dataset.popupId;
  let maxAge = popupWrapper.dataset.maxAge
    ? +popupWrapper.dataset.maxAge
    : 86400;
  if (!pupop) return;
  let delay = pupop.dataset.delay ? +pupop.dataset.delay : 0;

  let status = parseInt(Cookie.get(`${id}_sale_modal`));

  if (!status) {
    setTimeout(function () {
      const $salesPopup = openPopup($("#sales"));
      $salesPopup.on("popup:beforeClose", () => setCookie());
      $salesPopup.on("popup:overlayClick", () => setCookie());
    }, delay);
  }

  function setCookie() {
    Cookie.set(`${id}_sale_modal`, 1, {
      samesite: "strict",
      "max-age": maxAge,
    });
  }

  function isNotExpTimer() {
    let timerEl = pupop.querySelector(".timer");
    if (!timerEl) return true;
    let currentDate = new Date(timerEl.dataset.date.replace(/-/g, "/"));
    return currentDate.getTime() - Date.now() > 0 ? true : false;
  }
  //for max-age
  function secToTomorrow() {
    let now = new Date();
    let tomorrow = new Date(Date.now() + 86400e3);
    tomorrow.setHours(0, 0, 0, 0);
    return Math.round((tomorrow - now) / 1000);
  }
  //for expires
  function addOneDayFromNow() {
    let date = new Date(Date.now() + 86400e3);
    date = date.toUTCString();
    return date;
  }
});
