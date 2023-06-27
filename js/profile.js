
// OPEN EDIT PROFILE MODAL
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("addBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



// INSIDE EDIT PROFILE MODAL

var imageBtn = document.getElementById("imageBtn");
var contactBtn = document.getElementById("contactBtn");
var backgroundBtn = document.getElementById("backgroundBtn");

var imageEdit = document.getElementById("imageEdit");
var contactsEdit = document.getElementById("contactsEdit");
var backgroundEdit = document.getElementById("backgroundEdit");


const modalNav = document.querySelector('.modal-nav');
const modalBtns = document.querySelector('.modal-nav-buttons');

imageBtn.onclick = function(){
  modalNav.classList.toggle('active-buttons');
  modalBtns.classList.toggle('active-buttons');
  imageEdit.style.display = "flex";
  contactsEdit.style.display = "none";
  backgroundEdit.style.display = "none";

}

contactBtn.onclick = function(){
  modalNav.classList.toggle('active-buttons');
  modalBtns.classList.toggle('active-buttons');
  imageEdit.style.display = "none";
  contactsEdit.style.display = "flex";
  backgroundEdit.style.display = "none";

}

backgroundBtn.onclick = function(){
  modalNav.classList.toggle('active-buttons');
  modalBtns.classList.toggle('active-buttons');
  imageEdit.style.display = "none";
  contactsEdit.style.display = "none";
  backgroundEdit.style.display = "flex";

}



///////////////////////////////////////////////////////
/////////////////IMAGE ADD DISPLAY/////////////////////
///////////////////////////////////////////////////////

function triggerClick(){
  document.querySelector('#file').click();
}

function displayImage(e){
  if(e.files[0]){
    var reader = new FileReader();

    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}