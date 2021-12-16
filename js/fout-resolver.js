(function () {
  if (!document.fonts || document.fonts.check('16px "Roboto Condensed"')) {
    console.log('Roboto Condensed loaded from cache');
    return;
  }
    
    var fontRC = new FontFaceObserver('Roboto Condensed', {
      weight: 400
    });
    
    document.documentElement.classList.add('rc-font-inactive')
    fontRC.load().then(function () {
      console.log('Roboto Condensed font is available');
      document.documentElement.classList.remove('rc-font-inactive')
    });
})();
