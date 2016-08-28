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
//edicion de productos
function editdiv_showP(id,nombre,precio) {
  document.getElementById('edit').style.display = "block";
  document.getElementById('idP').value=id;
  document.getElementById('nameP').value=nombre;
  document.getElementById('precioP').value=precio;
}
//edicion de gastos
function editdiv_showG(id,idR,nombre,precio) {
  document.getElementById('edit').style.display = "block";
  document.getElementById('idG').value=id;
  document.getElementById('idRG').value=idR;
  document.getElementById('nameG').value=nombre;
  document.getElementById('precioG').value=precio;
}
//edicion de abono
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
//esconder lo del deudor
function deudorF(){
  document.getElementById('deudor').style.display="block";
}
function deudorHide(){
  document.getElementById('deudor').style.display="none";
}
//esconder lo del rubro
function rubroE(){
  document.getElementById('rubroExistente').style.display="block";
  document.getElementById('rubroNuevo').style.display="none";
}
function rubroN(){
  document.getElementById('rubroNuevo').style.display="block";
  document.getElementById('rubroExistente').style.display="none";
}

/*name
precio
tiporubro
tiporubro
rubroNuevo
rubroExistente
*/
