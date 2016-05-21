<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_easyb');
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('index');
	}

	public function login(){
		$this->load->view('login');
	}

	public function signin(){
		$this->load->view('signin');
	}


	public function panel(){
		if ($this->session->flashdata('email')==null) {
			$cuenta=$this->input->post('email');
			$clave=$this->input->post('password');
			//echo "no flashdata";
	}else{
		//echo "si flashdata";
		$cuenta=$this->session->flashdata('email');
		$clave=$this->session->flashdata('password');
	}
		$res=$this->m_easyb->validarusuario($cuenta,$clave);
		//print_r($res);
		if (!empty($res)){
			$datos=array('id_usuario'=>$res[0]['id_usuario'],
										'correo'=>$res[0]['correo'],
										'nombre'=>$res[0]['nombre'],
										'apellido'=>$res[0]['apellido'],
										'clave_registro'=>$res[0]['clave_registro']);
			$this->session->set_userdata($datos);
			$this->load->view('panel');
		}
		else{
			$this->load->view('login');
		}
	}

	function cierraSesion(){
		$this->session->sess_destroy();
		redirect('welcome/login');
	}

	public function productos(){
		$data = array(
			'productos'=>$this->m_easyb->getproductos()
			);
		$this->load->view('productos',$data);
	}

	public function ventas(){
		$data = array(
			'ventas'=>$this->m_easyb->getventas(),
			'adeudos'=>$this->m_easyb->getadeudos(),
			'productos'=>$this->m_easyb->getproductos()
			);
		$this->load->view('ventas',$data);
	}
	public function gastos(){
		$data = array(
			'gastosgeneral'=>$this->m_easyb->getgastos()
			);
		$this->load->view('gastos',$data);
	}
	public function getdetallegastos(){
		if ($this->session->flashdata('id_rubro')==null) {
			$id_rubro = $_GET['id_rubro'];
		}else{
			$id_rubro = $this->session->flashdata('id_rubro');
		}

		$data = array(
			'detallegastos'=>$this->m_easyb->getdetallegastos($id_rubro),
			'catalogogastos'=>$this->m_easyb->getcatalogogastos($id_rubro)
			);

		$this->load->view('gastos_detalle',$data);
	}

	public function razones(){
		$data = array(
			'rotacion'=>$this->m_easyb->getrotacion()
			);
		$this->load->view('razones',$data);
	}

	public function graficas(){
		$data = array(
			'datos_rubros'=>$this->m_easyb->getgastos(),
			'datos_actuales'=>$this->m_easyb->getdetallegastosfull()
			);
		$this->load->view('graficas',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
