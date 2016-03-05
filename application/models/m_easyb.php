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

}
