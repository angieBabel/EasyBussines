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

		if ($this->session->userdata('id_usuario')==null) {
			$cuenta=$this->input->post('email');
			$clave=$this->input->post('password');
			$res=$this->m_easyb->validarusuario($cuenta,$clave);
			//print_r($res);
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
				$data = array(
					'ventasMes'=>$this->m_easyb->getresumenventas(),
					'comparativaVentas'=>$this->m_easyb->getcomparativaventas()
					/*'productosMes'=>$this->m_easyb->getventasproductos()*/
					);
				$this->load->view('panel',$data);
			}
			else{
				$this->load->view('login');
			}
		}else{
			$data = array(
					'ventasMes'=>$this->m_easyb->getresumenventas(),
					'comparativaVentas'=>$this->m_easyb->getcomparativaventas()
					);
				$this->load->view('panel',$data);
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
			'productos'=>$this->m_easyb->getproductos(),
			'sumaventas'=>$this->m_easyb->getsumaventas()
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
			'ventasPeriodo'=>$this->m_easyb->getventascontado(),
			'comparativaVentas'=>$this->m_easyb->getventasFull(),
			'gastosPeriodo'=>$this->m_easyb->getdetallegastosfull(),
			'comparativaGastos'=>$this->m_easyb->getdetallegastoscomparativa()
			);
		$this->load->view('graficas',$data);
	}
//variables de configuracion
	public function customFI(){
		$fi = $_GET['fecha_inicio'];
		$this->session->set_userdata('fechaInicio', $fi);
		$met = $_GET['met'];
		redirect('welcome/'.$met);
	}
	public function customFF(){
		$fi = $_GET['fecha_fin'];
		$this->session->set_userdata('fechaFin', $fi);
		$met = $_GET['met'];
		redirect('welcome/'.$met);
	}
	public function custom(){
		$tg = $_GET['tg'];
		$this->session->set_userdata('tipografica', $tg);
		$met = $_GET['met'];
		redirect('welcome/'.$met);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
