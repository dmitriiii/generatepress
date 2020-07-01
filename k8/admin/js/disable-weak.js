document.addEventListener("DOMContentLoaded", function(event) { 
    var elements = document.getElementsByClassName('pw-weak');
    // console.log(elements);
    var requiredElement = elements[0];
    requiredElement.remove();
});