<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_easyb extends CI_Model{
  function __construct(){
    parent::__construct();
  }
//Validar usuario

function validarusuario($cuenta,$clave){
  return $this->db->from('usuarios')
              ->where('correo',$cuenta)
              ->where('contrasenia',$clave)
              ->get()
              ->result_array();
   }
//Obtencion de datos
 public function getresumenventas(){
   return $this->db->select('productos.nombre as nombreproducto, ventas.modo_pago as modopago,
    SUM(ventas.unidades_vendidas) as totalUV')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('month(ventas.fecha)',date("m"))
              ->group_by("productos.nombre")
              ->order_by("totalUV","DESC")
              ->get()
              ->result_array();
 }
 /*public function getventasproductos(){
    return $this->db->select('productos.nombre as nombreproducto, ventas.modo_pago as modopago')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('month(ventas.fecha)',date("m"))
              ->get()
              ->result_array();
 }*/


 public function getproductos(){
   return $this->db->from('productos')
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
 }

 public function getventas(){
    return $this->db->select('ventas.id_venta as idventa, productos.nombre as nombreproducto, productos.precio as precioproducto, ventas.unidades_vendidas as cantidad, ventas.modo_pago as modopago, ventas.fecha as fechaventa, ventas.total as totalventa, productos.id_producto as idProducto')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
              ->get()
              ->result_array();
 }
 public function getadeudos(){
   return $this->db->select('productos.nombre as nombreproducto, adeudos.deudor as deudor, adeudos.deuda as deuda, adeudos.abono as abono, adeudos.abono_periodo,ventas.fecha as fechaventa, adeudos.id_adeudo as idAdeudo')
              ->from('adeudos')
              ->join('ventas','adeudos.id_venta=ventas.id_venta')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('adeudos.id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
 }

  public function getgastos(){
    return $this->db->select('rubros.nombre as nombrerubro, rubros.id_rubro as rubro')
                ->select_sum('gastos.total','totalgasto')
                ->from('gastos')
                ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
                ->join('rubros','catalogo_gastos.id_rubro=rubros.id_rubro','left')
                ->group_by('rubros.id_rubro')
                ->where('rubros.id_usuario',$this->session->userdata('id_usuario'))
                ->where('gastos.fecha >=',$this->session->userdata('fechaInicio'))
                ->where('gastos.fecha <=',$this->session->userdata('fechaFin'))
                ->or_where('rubros.id_usuario',0)
                ->get()
                ->result_array();
  }

  public function getcatalogogastos($id_rubro){
   return $this->db->select('catalogo_gastos.id_concepto as idconcepto, catalogo_gastos.nombre as nombreconcepto, catalogo_gastos.costo as costo, catalogo_gastos.id_rubro as rubro')
              ->from('catalogo_gastos')
              ->where('catalogo_gastos.id_rubro',$id_rubro)
              ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
              /*->limit(2)*/
              ->get()
              ->result_array();
  }
  public function getdetallegastos($id_rubro){
   return $this->db->select('gastos.id_gasto as idgasto, catalogo_gastos.nombre as nombreconcepto, gastos.cantidad as cantidad, gastos.fecha as fecha, gastos.total as totalgasto, catalogo_gastos.id_rubro as rubro')
              ->from('gastos')
              ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
              ->where('catalogo_gastos.id_rubro',$id_rubro)
              ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
              ->where('gastos.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('gastos.fecha <=',$this->session->userdata('fechaFin'))
              ->get()
              ->result_array();
  }
  public function getrotacion(){
    return $this->db->select('modo_pago as mp')
                    ->from('ventas')
                    ->where('id_usuario',$this->session->userdata('id_usuario'))
                    ->get()
                    ->result_array();
  }
  //para las graficas
   public function getdetallegastosfull(){
     return $this->db->select('gastos.id_gasto as idgasto, catalogo_gastos.nombre as nombreconcepto, gastos.cantidad as cantidad, gastos.fecha as fecha, gastos.total as totalgasto, catalogo_gastos.id_rubro as rubro')
                ->from('gastos')
                ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
                ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
                ->where('gastos.fecha >=',$this->session->userdata('fechaInicio'))
                ->where('gastos.fecha <=',$this->session->userdata('fechaFin'))
                ->get()
                ->result_array();
  }

  public function getventascontado(){
    return $this->db->select('productos.nombre as nombreproducto,ventas.unidades_vendidas as cantidad, ventas.total as totalventa')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('ventas.modo_pago',1)
              ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
              /*->where('ventas.fecha',$this->session->userdata('periodo')*/
              ->get()
              ->result_array();

  }




//Altas
  public function signin($email,$nombre,$apellido,$password){
    $this->db->set('correo',$email)
            ->set('nombre',$nombre)
            ->set('apellido',$apellido)
            ->set('contrasenia',$password)
            ->insert('usuarios');
  }
  public function altaproducto($id_usuario,$name,$precio){
      $this->db->set('id_usuario',$id_usuario)
            ->set('nombre',$name)
            ->set('precio',$precio)
            ->insert('productos');
  }
  public function altaventa($id_usuario,$nombre,$precio,$cantidad,$modopago,$deudor,$fecha){

    if ($modopago=='Contado') {
      $this->db->set('id_producto',$nombre)//$nombre trae el id del producto
                ->set('id_usuario',$id_usuario)
                ->set('unidades_vendidas',$cantidad)
                ->set('fecha',$fecha)
                ->set('modo_pago',0)
                ->set('total',$precio*$cantidad)
                ->insert('ventas');
    }else{
      $this->db->set('id_producto',$nombre)//$nombre trae el id del producto
                ->set('id_usuario',$id_usuario)
                ->set('unidades_vendidas',$cantidad)
                ->set('fecha',$fecha)
                ->set('modo_pago',1)
                ->set('total',$precio*$cantidad)
                ->insert('ventas');
      $venta='SELECT count(id_venta) FROM ventas';
      echo $venta;


     /* $this->db->set('id_usuario',$id_usuario)
                ->set('id_venta',$venta)
                ->set('deudor',$deudor)
                ->set('deuda',$precio*$cantidad)
                ->insert('adeudos');*/
    }
  }
  public function altarubro($id_usuario,$name){
      $this->db->set('id_usuario',$id_usuario)
            ->set('nombre',$name)
            ->insert('rubros');
  }
  public function altagasto($id_usuario,$nombre,$cantidad,$costo){
    $this->db->set('id_concepto',$nombre)
              ->set('id_usuario',$id_usuario)
              ->set('cantidad',$cantidad)
              ->set('fecha',date('Y-m-d'))
              ->set('total',$cantidad*$costo)
              ->insert('gastos');
  }



//Bajas
  public function eliminaproducto($id){
    $this->db->where('id_producto',$id)
             ->delete('productos');
  }

  public function eliminaventa($id){
    $this->db->where('id_venta',$id)
             ->delete('ventas ');
  }

  public function eliminagasto($id){
    $this->db->where('id_gasto',$id)
             ->delete('gastos ');
  }

//editar
  public function editaproductos($idProducto,$nombre,$precio){
    $this->db->set('nombre',$nombre)
             ->set('precio',$precio)
             ->where('id_producto',$idProducto)
             ->update('productos');
  }

  /*public function newAbono(){
    return
              ->result_array();
  }*/

  public function editaadeudo($idAdeudo,$abonoT,$abonoperiodo){
      $this->db->set('abono',$abonoT)
               ->set('abono_periodo',$abonoperiodo)
               ->where('id_adeudo',$idAdeudo)
               ->update('adeudos');
  }
}
