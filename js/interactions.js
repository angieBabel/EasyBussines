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
alert(document.getElementById(idP).value);
document.getElementById('nameP').value=nombre;
document.getElementById('precioP').value=precio;

}


//Function to Hide Popup
function editdiv_hide(){
document.getElementById('edit').style.display = "none";
}

//funcion para obtener el id de del producto a vender
function mostarCostos(){

}
