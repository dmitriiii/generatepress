document.addEventListener("DOMContentLoaded", function (event) {
  $(".timer").each(function (i, el) {
    var expDate = new Date(el.dataset.date);
    var timer = setInterval(function () {
      timeBetweenDates(expDate);
    }, 1000);

    function timeBetweenDates(expDate) {
      var dateEntered = expDate;
      var now = new Date();
      var difference = dateEntered.getTime() - now.getTime();
      if (difference <= 0) {
        // Timer done
        clearInterval(timer);
      } else {
        var seconds = Math.floor(difference / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        hours %= 24;
        minutes %= 60;
        seconds %= 60;

        $(el)
          .find(".timer__dd")
          .text(days < 10 ? "0" + days : days);
        $(el)
          .find(".timer__hh")
          .text(hours < 10 ? "0" + hours : hours);
        $(el)
          .find(".timer__mm")
          .text(minutes < 10 ? "0" + minutes : minutes);
        $(el)
          .find(".timer__ss")
          .text(seconds < 10 ? "0" + seconds : seconds);
      }
    }
  });
});
