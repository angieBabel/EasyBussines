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
  //funcion para tener el resumen de las ventas en home
 public function getresumenventas(){
   return $this->db->select('productos.nombre as nombreproducto, ventas.modo_pago as modopago, SUM(ventas.unidades_vendidas) as totalUV,SUM(ventas.total) as totalventa')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('month(ventas.fecha)',date("m"))
              ->group_by("productos.nombre")
              ->order_by("totalUV","DESC")
              ->limit(5)
              ->get()
              ->result_array();
 }
 //funcion para tener la comparativa de las ventas en home
 public function getcomparativaventas(){
    return $this->db->select('ventas.modo_pago as modopago, Count(ventas.modo_pago) as totalmodopago')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('month(ventas.fecha)',date("m"))
              ->group_by('ventas.modo_pago')
              ->get()
              ->result_array();
 }
  //obtener los productos
 public function getproductos(){
   return $this->db->from('productos')
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->order_by("id_producto","ASC")
              ->get()
              ->result_array();
 }
 //obtener las ventas
 public function getventas(){
    return $this->db->select('ventas.id_venta as idventa, productos.nombre as nombreproducto, productos.precio as precioproducto, ventas.unidades_vendidas as cantidad, ventas.modo_pago as modopago, ventas.fecha as fechaventa, ventas.total as totalventa, productos.id_producto as idProducto')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
              ->order_by("id_venta","ASC")
              ->get()
              ->result_array();
 }

 //obtener los conceptos de gastos
 public function getcatgastos(){
      return $this->db->select('rubros.nombre as nombrerubro, rubros.id_rubro as id_rubro, catalogo_gastos.id_concepto as id_concepto, catalogo_gastos.nombre as nombre, catalogo_gastos.costo as costo')
              ->from('catalogo_gastos')
              ->join('rubros','catalogo_gastos.id_rubro=rubros.id_rubro')
              ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
              ->order_by("rubros.id_rubro","ASC")
              ->get()
              ->result_array();
 }
 //obtener rubros
 public function getrubros(){
      return $this->db->select('id_rubro, nombre')
              ->from('rubros')
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->or_where('id_usuario',0)
              ->order_by("id_rubro","ASC")
              ->get()
              ->result_array();
 }

 public function getsumaventas(){
   return $this->db->select('SUM(total) as sumatotal')
              ->from('ventas')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
              ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
              ->get()
              ->result_array();
 }

 public function getprecio($idProducto){
   return $this->db->select('precio')
              ->from('productos')
              -> where('id_producto',$idProducto)
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
 }

 public function getadeudos(){
   return $this->db->select('productos.nombre as nombreproducto, adeudos.deudor as deudor, adeudos.deuda as deuda, adeudos.abono as abono, adeudos.abono_periodo,ventas.fecha as fechaventa, adeudos.id_adeudo as idAdeudo')
              ->from('adeudos')
              ->join('ventas','adeudos.id_venta=ventas.id_venta')
              ->join('productos','ventas.id_producto=productos.id_producto','left')
              ->where('adeudos.id_usuario',$this->session->userdata('id_usuario'))
              ->order_by("id_adeudo","ASC")
              ->get()
              ->result_array();
 }
 public function getdeuda($idAdeudo){
   return $this->db->select('adeudos.deuda as deuda, adeudos.abono as abono, adeudos.id_adeudo as idAdeudo, adeudos.id_venta as idVenta')
              ->from('adeudos')
              ->join('ventas','adeudos.id_venta=ventas.id_venta','left')
              ->where('adeudos.id_usuario',$this->session->userdata('id_usuario'))
              ->where('adeudos.id_adeudo',$idAdeudo)
              ->get()
              ->result_array();
 }
  //resumen de los gastos
public function getgastos(){
  return $this->db->select('rubros.nombre as nombrerubro, rubros.id_rubro as rubro, SUM(gastos.total) as totalgasto, gastos.fecha as fechaGasto')
              ->from('gastos')
              ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
              ->join('rubros','catalogo_gastos.id_rubro=rubros.id_rubro','left')
              ->group_by('nombrerubro')
              ->where('gastos.id_usuario',$this->session->userdata('id_usuario'))
              ->where('gastos.fecha >=',$this->session->userdata('fechaInicio'))
              ->where('gastos.fecha <=',$this->session->userdata('fechaFin'))
              ->order_by("rubros.id_rubro","ASC")
              ->get()
              ->result_array();
}

  public function getcatalogogastos(){
   return $this->db->select('catalogo_gastos.id_concepto as idconcepto, catalogo_gastos.nombre as nombreconcepto, catalogo_gastos.costo as costo, catalogo_gastos.id_rubro as rubro')
              ->from('catalogo_gastos')
              //->where('catalogo_gastos.id_rubro',$id_rubro)
              ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
              ->order_by("id_concepto","ASC")
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
              ->order_by("id_gasto","ASC")
              ->get()
              ->result_array();
  }
  public function getcosto($idconcepto){
   return $this->db->select('costo')
              ->from('catalogo_gastos')
              ->where('id_concepto',$idconcepto)
              ->where('id_usuario',$this->session->userdata('id_usuario'))
              ->get()
              ->result_array();
 }
  //obtencion de datos para la rotacion de cobros
  public function getrotacion(){
    return $this->db->select('modo_pago as mp')
                    ->from('ventas')
                    ->where('id_usuario',$this->session->userdata('id_usuario'))
                    ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
                    ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
                    ->get()
                    ->result_array();
  }
//para las graficas
  //saber las ventas de contado
    public function getventascontado(){
      return $this->db->select('productos.nombre as nombreproducto, SUM(ventas.unidades_vendidas)as cantidad, ventas.total as totalventa')
                ->from('ventas')
                ->join('productos','ventas.id_producto=productos.id_producto','left')
                ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
                ->where('ventas.modo_pago',0)
                ->where('ventas.fecha >=',$this->session->userdata('fechaInicio'))
                ->where('ventas.fecha <=',$this->session->userdata('fechaFin'))
                ->group_by('productos.nombre')
                ->get()
                ->result_array();
    }
  //obtener ls ventas completas
    public function getventasFull(){
     return $this->db->select('MONTH(ventas.fecha) as mes,SUM(ventas.total) as total')
                ->from('ventas')
                ->join('productos','ventas.id_producto=productos.id_producto','left')
                ->where('ventas.id_usuario',$this->session->userdata('id_usuario'))
                ->group_by('month(ventas.fecha)')
                ->get()
                ->result_array();
    }
  //obtener el detalle de todos los gastos
    public function getdetallegastosfull(){
       return $this->db->select('catalogo_gastos.nombre as nombreconcepto, gastos.cantidad as cantidad, SUM(gastos.total) as totalgasto')
                  ->from('gastos')
                  ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
                  ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
                  ->where('gastos.fecha >=',$this->session->userdata('fechaInicio'))
                  ->where('gastos.fecha <=',$this->session->userdata('fechaFin'))
                  ->group_by('catalogo_gastos.nombre')
                  ->get()
                  ->result_array();
    }
    public function getdetallegastoscomparativa(){
       return $this->db->select('MONTH(gastos.fecha) as mes, SUM(gastos.total) as totalgasto')
                  ->from('gastos')
                  ->join('catalogo_gastos','gastos.id_concepto=catalogo_gastos.id_concepto','left')
                  ->where('catalogo_gastos.id_usuario',$this->session->userdata('id_usuario'))
                  ->group_by('month(gastos.fecha)')
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
    $total=intval($precio)*intval($cantidad);

    if ($modopago=='Contado') {
      $this->db->set('id_producto',$nombre)//$nombre trae el id del producto
                ->set('id_usuario',$id_usuario)
                ->set('unidades_vendidas',$cantidad)
                ->set('fecha',$fecha)
                ->set('modo_pago',0)
                ->set('total',$total)
                ->insert('ventas');
    }else{
      $this->db->set('id_producto',$nombre)//$nombre trae el id del producto
                ->set('id_usuario',$id_usuario)
                ->set('unidades_vendidas',$cantidad)
                ->set('fecha',$fecha)
                ->set('modo_pago',1)
                ->set('total',$total)
                ->insert('ventas');

      $venta=$this->db->select('id_venta as lastventa')
              ->from('ventas')
              ->order_by("lastventa","DESC")
              ->limit(1)
              ->get()
              ->result_array();
      $idventa=$venta[0];

      $this->db->set('id_usuario',$id_usuario)
                ->set('id_venta',$idventa['lastventa'])
                ->set('deudor',$deudor)
                ->set('deuda',$precio*$cantidad)
                ->insert('adeudos');
    }
  }
  public function altacatgasto($idUsuario,$nombre,$precio,$rubroExistente,$tiporubro){
    if ($tiporubro=="Existe") {
      $this->db->set('id_usuario',$idUsuario)
                ->set('id_rubro',$rubroExistente)
                ->set('nombre',$nombre)
                ->set('costo',$precio)
                ->insert('catalogo_gastos');
    }else{
      $rubro=$this->db->select('id_rubro as lastrubro')
              ->from('rubros')
              ->order_by("lastrubro","DESC")
              ->limit(1)
              ->get()
              ->result_array();
      $idrubro=$rubro[0];

      $this->db->set('id_usuario',$idUsuario)
                ->set('id_rubro',$idrubro['lastrubro'])
                ->set('nombre',$nombre)
                ->set('costo',$precio)
                ->insert('catalogo_gastos');
    }

  }
  public function altarubro($id_usuario,$name){
      $this->db->set('id_usuario',$id_usuario)
            ->set('nombre',$name)
            ->insert('rubros');
  }
  public function altagasto($id_usuario,$idconcepto,$cantidad,$costo){
    $this->db->set('id_concepto',$idconcepto)
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

  public function eliminaconcepto($id){
    $this->db->where('id_concepto',$id)
             ->delete('catalogo_gastos');
  }

  public function eliminagasto($id){
    $this->db->where('id_gasto',$id)
             ->delete('gastos ');
  }

//Ediciones
  public function editaproductos($idProducto,$nombre,$precio){
    $this->db->set('nombre',$nombre)
             ->set('precio',$precio)
             ->where('id_producto',$idProducto)
             ->update('productos');
  }

  public function editacatgastos($idConcepto,$idRubro,$nombre,$costo){
    $this->db->set('id_rubro',$idRubro)
             ->set('nombre',$nombre)
             ->set('costo',$costo)
             ->where('id_concepto',$idConcepto)
             ->update('catalogo_gastos');
  }
  public function editaadeudo($idAdeudo,$abonoT,$abonoperiodo){
      $this->db->set('abono',$abonoT)
               ->set('abono_periodo',$abonoperiodo)
               ->where('id_adeudo',$idAdeudo)
               ->update('adeudos');
  }
  public function eliminaadeudo($idAdeudo,$idVenta){
    //para cambiar de estado esa venta
    $this->db->set('modo_pago',0)
              ->where('id_venta',$idVenta)
              ->update('ventas');
    //para borrar el aduedo una vez que ya se pago
    $this->db->where('id_adeudo',$idAdeudo)
            ->delete('adeudos');
  }
}
