<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_easyb extends CI_Model{
  function __construct(){
    parent::__construct();
  }
//Validar usuario
  /*public function validarUsuario($user,$pass){
        $this->db->where('email',$user);    //    La consulta se efectÃºa mediante Active Record. Una manera alternativa, y en lenguaje mÃ¡s sencillo, de generar las consultas Sql.
        $this->db->where('password',$pass);
        $query=$this->db->get('colono');
        return $query->result_array();
  }
  public function validarUsuario($cuenta,$clave){
    $this->db->where('email',$cuenta);
    $this->db->where('password',$clave);
    $query=$this->db->get('usuario');
    return $query->result_array();
   }*/

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
              ->where('id_usuario',1)
              ->get()
              ->result_array();
 }


 public function getventas(){
  return $this->db->select('ventas.id_venta as idventa, productos.nombre as nombreproducto, productos.precio as precioproducto, ventas.unidades_vendidas as cantidad, ventas.modo_pago as modopago, ventas.fecha as fechaventa, ventas.total as totalventa')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',1)
              ->get()
              ->result_array();
 }
 public function getadeudos(){
  return $this->db->from('adeudos')
              ->where('id_usuario',1)
              ->get()
              ->result_array();
 }

public function getgastos(){
  return $this->db->select('rubros.nombre as nombrerubro, rubros.id_rubro as rubro,gastos.total as totalgasto')
              ->select_sum('total')
              ->from('gastos')
              ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
              ->join('rubros','catalogo_gastos.id_rubro=rubros.id_rubro','left')
              ->group_by('rubros.id_rubro')
              ->get()
              ->result_array();
 }

 public function getdetallegastos($id_rubro){
  return $this->db->select('gastos.id_gasto as idgasto, catalogo_gastos.nombre as nombreconcepto, gastos.cantidad as cantidad, gastos.fecha as fecha, gastos.total as totalgasto')
              ->from('gastos')
              ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
              ->where('catalogo_gastos.id_rubro',$id_rubro)
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

//Bajas

}
