<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class uploader extends CI_Controller {
  function __construct(){
    parent::__construct();
   // $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('m_easyb');
  }

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
//altas
  public function signin(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_message('valid_email','El campo %s debe ser un correo valido');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[usuarios.correo]|valid_email');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('nombre','Nombre','required');
    $this->form_validation->set_rules('apellido','Apellido','required');

      if ($this->form_validation->run() == FALSE){
        if ($this->session->userdata('signinGmail')==true) {
          $contents['user_profile'] = $this->session->userdata('user_profile');
          $datoss=$contents['user_profile'];
          $email=$datoss['email'];
          $nombre=$datoss['given_name'];
          $apellido=$datoss['family_name'];
          $password=$datoss['id'];
          //print_r($datoss);
        }elseif ($this->session->userdata('loginFB')==true) {
          # code...
        }else{
          echo "si entro al else de la validacion false";
         //redirect('welcome/signin');
        }
            if ($email!=null) {
              //$this->m_easyb->signin($email,$nombre,$apellido,$password);
              $res=$this->m_easyb->validarusuario($email,$password);

              if (!empty($res)){
                $datos=array('id_usuario'=>$res[0]['id_usuario'],
                        'correo'=>$res[0]['correo'],
                        'nombre'=>$res[0]['nombre'],
                        'apellido'=>$res[0]['apellido'],
                        'clave_registro'=>$res[0]['clave_registro'],
                        'fechaInicio'=>date('Y-m-d', strtotime('-1 month')),
                        'fechaFin'=>date('Y-m-d'),
                        'tipografica'=>'pastel'
                        );
                $this->session->set_userdata($datos);
                //$this->load->view('panel');
                redirect('welcome/panel');
              }
            }
            //echo "si inicio sesion";

            /*redirect('welcome/panel');*/
      }else{
        if ($this->session->userdata('signinGmail')==true) {
          echo "entro al loginGMAIL";
          $datoss=$contents['user_profile'];
          $email=$datoss['email'];
          $nombre=$datoss['given_name'];
          $apellido=$datoss['family_name'];
          $password=$datoss['id'];
        }elseif ($this->session->userdata('loginFB')==true) {
          # code...
        }else{
          //Acción a tomas si no existe ningun error
            $email=$this->input->POST('email');
            $nombre=$this->input->POST('nombre');
            $apellido=$this->input->POST('apellido');
            $password=$this->input->POST('password');
        }
            $this->m_easyb->signin($email,$nombre,$apellido,$password);
            $res=$this->m_easyb->validarusuario($email,$password);
            print_r($res);
            if (!empty($res)){
              $datos=array('id_usuario'=>$res[0]['id_usuario'],
                      'correo'=>$res[0]['correo'],
                      'nombre'=>$res[0]['nombre'],
                      'apellido'=>$res[0]['apellido'],
                      'clave_registro'=>$res[0]['clave_registro'],
                      'fechaInicio'=>date('Y-m-d', strtotime('-1 month')),
                      'fechaFin'=>date('Y-m-d'),
                      'tipografica'=>'pastel'
                      );
              $this->session->set_userdata($datos);
              /*$this->load->view('panel');*/

              //redirect('welcome/panel');
            }
            echo "si inicio sesion";

            /*redirect('welcome/panel');*/
        }
      }

  public function altaProducto(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[productos.nombre]');
    $this->form_validation->set_rules('precio','Precio','required');
      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
        redirect('welcome/productos');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $id_usuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');
            $precio=$this->input->POST('precio');
            $this->m_easyb->altaproducto($id_usuario,$nombre,$precio);
            redirect('welcome/productos');
      }
  }

  public function altaventa(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[productos.nombre]');
    /*$this->form_validation->set_rules('precio','Precio','required');*/
      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        redirect('welcome/ventas');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $id_usuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');//trae el id del producto
            $precioarray=$this->m_easyb->getprecio($nombre);
            $precio=$precioarray[0];
            $cantidad=$this->input->POST('cantidad');
            $modopago=$this->input->POST('modopago');
            $deudor=$this->input->POST('deudor');
            $fecha=date('Y-m-d');
            $this->m_easyb->altaventa($id_usuario,$nombre,$precio['precio'],$cantidad,$modopago,$deudor,$fecha);
            redirect('welcome/ventas');
      }
  }

  public function altacatgasto(){

    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[catalogo_gastos.nombre]');
      if ($this->form_validation->run() == FALSE)
      {
        echo "no jalo";
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $idUsuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');
            $precio=$this->input->POST('precio');
            $tiporubro=$this->input->POST('tiporubro');
            $rubroExistente=$this->input->POST('rubroExistente');
            $rubroNuevo=$this->input->POST('rubroNuevo');
            if ($tiporubro=="Existe") {
              $this->m_easyb->altacatgasto($idUsuario,$nombre,$precio,$rubroExistente,$tiporubro);
            }else{
              $this->m_easyb->altarubro($idUsuario,$rubroNuevo);
              $this->m_easyb->altacatgasto($idUsuario,$nombre,$precio,$rubroExistente,$tiporubro);
            }
            redirect('welcome/catalogogastos');
      }
  }

  public function altagasto(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    /*$this->form_validation->set_rules('name', 'Name', 'required|is_unique[productos.nombre]');*/
    $this->form_validation->set_rules('cantidad','Cantidad','required');
      if ($this->form_validation->run() == FALSE)
      {
        redirect('welcome/gastos');
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {

         //Acción a tomas si no existe ningun error
            //$id_rubro=$this->input->POST('rubro');
            //$this->session->set_flashdata('id_rubro',$id_rubro);//flash data para mandar id del rubro y redireccionar correctamente
            $id_usuario=$this->session->userdata('id_usuario');
            $idconcepto=$this->input->POST('idconcepto');
            $cantidad=$this->input->POST('cantidad');
            $costoarray=$this->m_easyb->getcosto($idconcepto);
            $costo=$costoarray[0];
            $this->m_easyb->altagasto($id_usuario,$idconcepto,$cantidad,$costo['costo']);
            redirect('welcome/gastos');
      }
    }

//Bajas
  public function eliminaproducto(){
    $id = $_GET['id'];
    $this->m_easyb->eliminaproducto($id);
    redirect('welcome/productos');
  }

  public function eliminaventa(){
    $id = $_GET['id'];
    $this->m_easyb->eliminaventa($id);
    redirect('welcome/ventas');
  }

  public function eliminaconcepto(){
    $id = $_GET['id'];
    $this->m_easyb->eliminaconcepto($id);
    redirect('welcome/catalogogastos');
  }

  public function eliminagasto(){
    $id_rubro=$_GET['rubro'];
    $this->session->set_flashdata('id_rubro',$id_rubro);//flash data para mandar id del rubro y redireccionar correctamente
    $id=$_GET['id'];
    $this->m_easyb->eliminagasto($id);
    redirect('welcome/getdetallegastos');
  }

//Modificaciones
  public function editaproducto(){
    $id_producto=$this->input->POST('idP');
    $nombre=$this->input->POST('nameP');
    $precio=$this->input->POST('precioP');
    $this->m_easyb->editaproductos($id_producto,$nombre,$precio);
    redirect('welcome/productos');
  }

  public function editacatgastos(){
    $idConcepto=$this->input->POST('idG');
    $idRubro=$this->input->POST('idRG');
    $nombre=$this->input->POST('nameG');
    $costo=$this->input->POST('precioG');
    $this->m_easyb->editacatgastos($idConcepto,$idRubro,$nombre,$costo);
    redirect('welcome/catalogogastos');
  }

  public function editaadeudo(){
    $idAdeudo=$this->input->POST('idAdeudo');
    $abonoT=$this->input->POST('abonoT');
    $abonoPeriodo=$this->input->POST('abonoperiodo');
    $this->m_easyb->editaadeudo($idAdeudo,$abonoT+$abonoPeriodo,$abonoPeriodo);
    $abonorestantearray=$this->m_easyb->getdeuda($idAdeudo);
    $abonorestante=$abonorestantearray[0];
    if ($abonorestante['abono']==$abonorestante['deuda']) {
      $this->m_easyb->eliminaadeudo($abonorestante['idAdeudo'],$abonorestante['idVenta']);
    }
    redirect('welcome/ventas');
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
