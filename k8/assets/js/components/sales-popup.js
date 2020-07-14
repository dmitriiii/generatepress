document.addEventListener("DOMContentLoaded", function (event) {
  let popup = document.getElementById("sales");
  if (!popup) return;
  let cSpe = parseInt(Cookie.get("_sale_modal"))
  let dSpe = parseInt(popup.dataset.times)
  let spe =
    (isNaN(cSpe) ? 1 : cSpe) || dSpe || 1;
  Cookie.set("_sale_modal", --spe, {
    samesite: "strict",
    "max-age": secToTomorrow(),
  });
  if (!spe) openPopup($("#sales"));

  function secToTomorrow() {
    let now = new Date();
    let tomorrow = new Date(Date.now() + 86400e3);
    tomorrow.setHours(0,0,0,0)
    return Math.round((tomorrow - now) / 1000);
  }
});
