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
              ->get()
              ->result_array();
 }

 public function getventas(){
  return $this->db->from('ventas')
              ->get()
              ->result_array();
 }
 public function getadeudos(){
  return $this->db->from('adeudos')
              ->get()
              ->result_array();
 }

public function getgastos(){
  return $this->db->from('gastos')
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
