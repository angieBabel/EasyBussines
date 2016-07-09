//Function To Display Popup
function newdiv_show() {
document.getElementById('new').style.display = "block";
}
//Function to Hide Popup
function newdiv_hide(){
document.getElementById('new').style.display = "none";
}
//Function To Display Popup
function editdiv_show() {
document.getElementById('edit').style.display = "block";
}
function editdiv_showP(id,nombre,precio) {
  document.getElementById('edit').style.display = "block";
  document.getElementById('idP').value=id;
  document.getElementById('nameP').value=nombre;
  document.getElementById('precioP').value=precio;
}
function editdiv_showA(id,nombre,abono,ap) {
  document.getElementById('edit').style.display = "block";

  document.getElementById('idAdeudo').value=id;
  document.getElementById('venta').value=nombre;
  document.getElementById('abonoT').value=abono;
}


//Function to Hide Popup
function editdiv_hide(){
document.getElementById('edit').style.display = "none";
}

function deudorF(){
  document.getElementById('deudor').style.display="block";
}
