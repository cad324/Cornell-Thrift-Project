// ask for line to validate the javascript

var myIndex = 0;
showslides();

function showslides() {
  var i;
  var x = document.getElementsByClassName("slides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) { myIndex = 1 }
  x[myIndex - 1].style.display = "block";
  setTimeout(showslides, 2000); // Change image every 2 seconds
}
