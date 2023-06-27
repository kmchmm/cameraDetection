

// NUMBER OF INTRUSIONS
// Get the modal
var modal1 = document.getElementById("myModal1");
var modal4 = document.getElementById("myModal4");


// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");
var btn4 = document.getElementById("myBtn4");


// Get the <span> element that closes the modal
var span1= document.getElementsByClassName("close1")[0];
var span4 = document.getElementsByClassName("close4")[0];


// When the user clicks the button, open the modal 
btn1.onclick = function() {
  modal1.style.display = "block";
}

btn4.onclick = function() {
	modal4.style.display = "block";
}
  

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  modal1.style.display = "none";
}


span4.onclick = function() {
	modal4.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal1){
	  modal1.style.display = "none"; 
	} else if(event.target == modal4){
		modal4.style.display = "none"; 
	}
}


