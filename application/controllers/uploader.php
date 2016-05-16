<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class uploader extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
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
  public function signin()
  {
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[usuarios.correo]');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('nombre','Nombre','required');
    $this->form_validation->set_rules('apellido','Apellido','required');

      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $email=$this->input->POST('email');
            $nombre=$this->input->POST('nombre');
            $apellido=$this->input->POST('apellido');
            $password=$this->input->POST('password');
            $this->m_easyb->signin($email,$nombre,$apellido,$password);
            $this->session->set_flashdata('email',$email);
            $this->session->set_flashdata('password',$password);
            redirect('welcome/panel');
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
    $this->form_validation->set_rules('precio','Precio','required');
      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        redirect('welcome/productos');
      }
      else
      {


         //Acción a tomas si no existe ningun error
            $id_usuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');//trae el id del producto
            $precio=$this->input->POST('precio');
            $cantidad=$this->input->POST('cantidad');
            $modopago=$this->input->POST('modopago');
            $deudor=$this->input->POST('deudor');
            $fecha=date('Y-m-d');


            $this->m_easyb->altaventa($id_usuario,$nombre,$precio,$cantidad,$modopago,$deudor,$fecha);
            redirect('welcome/ventas');
      }
  }

  public function altarubro(){

    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[rubros.nombre]');
      if ($this->form_validation->run() == FALSE)
      {
        echo "no jalo";
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $id_usuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');
            $this->m_easyb->altarubro($id_usuario,$nombre);
            redirect('welcome/gastos');
      }
  }

  public function altaconcepto(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    /*$this->form_validation->set_rules('name', 'Name', 'required|is_unique[productos.nombre]');*/
      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {
         //Acción a tomas si no existe ningun error
            $id_usuario=$this->session->userdata('id_usuario');
            $nombre=$this->input->POST('name');
            $this->m_easyb->altarubro($id_usuario,$nombre);
            redirect('welcome/gastos');
      }
    }

  public function altagasto(){
    $this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[productos.nombre]');
    $this->form_validation->set_rules('cantidad','Cantidad','required');
      if ($this->form_validation->run() == FALSE)
      {
         //Acción a tomar si existe un error el en la validación
        //redirect('welcome/matAltaProductos');
      }
      else
      {

         //Acción a tomas si no existe ningun error
            $id_rubro=$this->input->POST('rubro');
            $this->session->set_flashdata('id_rubro',$id_rubro);//flash data para mandar id del rubro y redireccionar correctamente

            $id_usuario=$this->session->userdata('id_usuario');

            $nombre=$this->input->POST('name');
            $cantidad=$this->input->POST('cantidad');
            $costo=$this->input->POST('costo');
            $this->m_easyb->altagasto($id_usuario,$nombre,$cantidad,$costo);
            redirect('welcome/getdetallegastos');
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

  public function editaadeudo(){
    $idAdeudo=$this->input->POST('idAdeudo');
    $abonoT=$this->input->POST('abonoT');
    $abonoPeriodo=$this->input->POST('abonoperiodo');
    $this->m_easyb->editaadeudo($idAdeudo,$abonoT,$abonoPeriodo);
    redirect('welcome/ventas');


  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
