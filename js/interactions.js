// Validating Empty Field
function check_empty() {
  if (document.getElementById('name').value == "" || document.getElementById('precio').value == "") {
  alert("Debes de llenar todos los campos");
  } else {
  document.getElementById('form').submit();
  alert("Form Submitted Successfully...");
  }
}
//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}
