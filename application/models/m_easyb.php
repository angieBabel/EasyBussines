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
   /*public function getUTalla()
   {
    $this->db->order_by('clave','desc');
    $this->db->limit(1);
    $query=$this->db->get('tallas');
    return $query->result_array();
   }

  public function get_tallas(){
    return $this->db->from('tallas')
                ->where('estatus',1)
                ->get()
                ->result_array();
  }*/
//Obtencion de datos
 public function getproductos(){
  return $this->db->from('productos')
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();

 }

 public function getventas(){
  return $this->db->select('ventas.id_venta as idventa, productos.nombre as nombreproducto, productos.precio as precioproducto, ventas.unidades_vendidas as cantidad, ventas.modo_pago as modopago, ventas.fecha as fechaventa, ventas.total as totalventa')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
 }
 public function getadeudos(){
  return $this->db->select('productos.nombre as nombreproducto, adeudos.deudor as deudor, adeudos.deuda as deuda, adeudos.abono as abono, adeudos.abono_periodo,ventas.fecha as fechaventa')
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
                ->or_where('rubros.id_usuario',0)
                ->get()
                ->result_array();
   }

 public function getdetallegastos($id_rubro){
  return $this->db->select('gastos.id_gasto as idgasto, catalogo_gastos.nombre as nombreconcepto, gastos.cantidad as cantidad, gastos.fecha as fecha, gastos.total as totalgasto, catalogo_gastos.id_rubro as rubro')
              ->from('gastos')
              ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
              ->where('catalogo_gastos.id_rubro',$id_rubro)
              ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
  }
  /*public function getrazones(){
    return $thi->db->from('razones')
                  ->get()->result_array();
     };
  public function getgraficas(){
    return $thi->db->from('graficas')
                  ->get()->result_array();
     };*/
//Altas
  public function altaproducto($id_usuario,$name,$precio){
      $this->db->set('id_usuario',$id_usuario)
            ->set('nombre',$name)
            ->set('precio',$precio)
            ->insert('productos');
  }
  public function altarubro($id_usuario,$name){
      $this->db->set('id_usuario',$id_usuario)
            ->set('nombre',$name)
            ->insert('rubros');
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
  public function editaproducto($idProducto,$nombre,$precio){
    $this->db->set('nombre',$nombre)
             ->set('precio',$precio)
             ->where('id_producto',$idProducto)
             ->update('productos');

  }

/*public function editaproducto(){
    $idProducto=$this->input->POST('idP');
    $nombre=$this->input->POST('nameP');
    $precio=$this->input->POST('precioP');

    $this->m_easyb->editaproducto($idProducto,$nombre,$precio);
    redirect('welcome/productos');


  }*/


  public function actualizaumedida($clave,$descripcion,$factor){
    $estatus='1';
    $this->db->set('descripcion',$descripcion)
            ->set('factor_tbmedida',$factor)
            ->set('estatus',$estatus)
            ->where('clave',$clave)
            ->update('tbmedidas');
  }

}
