document.addEventListener("DOMContentLoaded", function(event) { 
  var elements = document.getElementsByClassName('pw-weak');
  if(elements.length > 0) {
  	var requiredElement = elements[0];
  	requiredElement.remove();
  }
});