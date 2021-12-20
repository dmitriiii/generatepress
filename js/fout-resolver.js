(function () {
  if (!document.fonts || document.fonts.check('16px "Roboto Condensed"')) {
    console.log("Roboto Condensed loaded from cache");
    return;
  }

  var fontRC = new FontFaceObserver("Roboto Condensed", {
    weight: 400,
  });

  addedStyles();

  document.documentElement.classList.add("rc-font-inactive");
  fontRC.load().then(function () {
    console.log("Roboto Condensed font is available");
    document.documentElement.classList.remove("rc-font-inactive");
    removeStyles();
  });

  function addedStyles() {
    const styleEl = document.createElement("style");
    styleEl.id = "rc-font-style-inactive";
    styleEl.innerHTML = `
      body {
        font-family: sans-serif;
        font-size: 15px;
        line-height: 1.7;
        letter-spacing: -0.25px;
      }`;
    const mainBodyStyle =
      document.querySelector("#generate-style-inline-css") ||
      document.querySelector("#body-style");
    if (!mainBodyStyle) return;
    mainBodyStyle.after(styleEl);
  }

  function removeStyles() {
    const styleEl = document.querySelector(".rc-font-style-inactive");
    if (styleEl) styleEl.remove();
  }
})();
