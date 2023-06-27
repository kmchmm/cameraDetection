

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
	document.getElementById("myDropdown").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
	  var dropdowns = document.getElementsByClassName("dropdown-content");
	  var i;
	  for (i = 0; i < dropdowns.length; i++) {
		var openDropdown = dropdowns[i];
		if (openDropdown.classList.contains('show')) {
		  openDropdown.classList.remove('show');
		}
	  }
	}

	  
  }


  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction1() {
	document.getElementById("myDropdown1").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
	  var dropdowns = document.getElementsByClassName("dropdown-content");
	  var i;
	  for (i = 0; i < dropdowns.length; i++) {
		var openDropdown = dropdowns[i];
		if (openDropdown.classList.contains('show')) {
		  openDropdown.classList.remove('show');
		}
	  }
	}
  }

  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction2() {
	document.getElementById("myDropdown2").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
	  var dropdowns = document.getElementsByClassName("dropdown-content");
	  var i;
	  for (i = 0; i < dropdowns.length; i++) {
		var openDropdown = dropdowns[i];
		if (openDropdown.classList.contains('show')) {
		  openDropdown.classList.remove('show');
		}
	  }
	}
  }

  

  
  ////////////////////////////////////////
  //////////////////CLOCK/////////////////
  ////////////////////////////////////////
  function updateClock(){
	var now = new Date();
	var dname = now.getDay(),
		month = now.getMonth(),
		dnum = now.getDate(),
		year = now.getFullYear(),
		hours = now.getHours(),
		minute = now.getMinutes(),
		second = now.getSeconds(),
		pe = "AM";

		if(hours == 0){
			hours = 12;
		}
		if(hours > 12) {
			hours = hours - 12;
			pe = "PM";
		}

		Number.prototype.pad = function(digits){
			for(var n = this.toString(); n.length < digits; n = 0 + n);
			return n;
		}

		var months = ["January","February","March","April","May","June","July","August","September","October","November","December",];
		var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
		var values = [week[dname], months[month], dnum.pad(2), year, hours.pad(2), minute.pad(2), second.pad(2), pe];

		for(var i = 0; i < ids.length; i++)
		document.getElementById(ids[i]).firstChild.nodeValue = values[i];
	
}
function initClock(){
	updateClock();
	window.setInterval("updateClock()", 1);
}


/*************************************/
/**********MOBILE NAVIGATION**********/
/*************************************/ 


const primaryNav = document.querySelector(".first-section-container");
const menuBtn = document.querySelector(".barNav");
const container = document.querySelector(".second-section-container");


menuBtn.addEventListener('click', () => {
	const visibility = 	primaryNav.getAttribute('data-visible');

	if(visibility === "false"){
		primaryNav.setAttribute("data-visible", true);
		menuBtn.setAttribute("aria-expanded", true);
		container.style.display = "none";
	} else if (visibility === "true"){
		primaryNav.setAttribute("data-visible", false);
		menuBtn.setAttribute("aria-expanded", false);
		container.style.display = "block";
	}
});