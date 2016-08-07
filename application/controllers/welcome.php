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

	/*public function login(){
		$this->load->view('login');
	}*/

	/*public function login(){
    $this->load->library('facebook');
    $user = $this->facebook->getUser();
    if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
    }else {
        $this->facebook->destroySession();
    }
    if ($user) {
        $data['logout_url']=site_url('welcome/cierraSesion');
    }else{
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('welcome/login'),
                'scope' => array("email")));
    }
    if (isset($_GET['code'])) {
			//echo $_GET['code'];

			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login',true);
			$this->session->set_userdata('user_profile3',$this->facebook->api('/me'));
			redirect('welcome/panel');
		}
		$data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('welcome/login'),
                'scope' => array("email")));
    $this->load->view('login',$data);
  }*/
	//gmail login
	 public function login(){

		if($this->session->userdata('login') == true){
			//redirect('welcome/profile');
		}

		if (isset($_GET['code'])) {
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('loginGmail',true);
			$this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());
			redirect('welcome/panel');
		}
		$contents['login_url'] = $this->googleplus->loginURL();

		$this->load->view('login',$contents);
	}

	public function signin(){
		$this->load->view('signin');
	}
	public function loginFB(){
		$this->load->view('loginFB');
	}
	public function panel(){
		/*$this->facebook->destroySession();*/
		$contents['user_profile'] = $this->session->userdata('user_profile');
		//print_r($contents);
		//print_r($this->session->userdata('loginGmail'));

		if ($this->session->userdata('id_usuario')==null) {
			if ($this->session->userdata('loginGmail')==true) {
				//echo "entro al loginGMAIL";
				$cuentas=$contents['user_profile'];
				$cuenta=$cuentas['email'];
				$clave=$cuentas['id'];
			}elseif ($this->session->userdata('loginFB')) {
				# code...
			}else{
				$cuenta=$this->input->post('email');
			  $clave=$this->input->post('password');
			}
			//$res=$this->m_easyb->validarusuario($cuenta,$clave);
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

					);
				$this->load->view('panel',$data);
			}
			else{
				//$this->load->view('login');
				$this->session->set_userdata('loginGmail',false);
				redirect('welcome/login');
				/*echo "no valido";*/
			}
		}else{
			$data = array(
					'ventasMes'=>$this->m_easyb->getresumenventas(),
					'comparativaVentas'=>$this->m_easyb->getcomparativaventas()
					);
				$this->load->view('panel',$data);
		}
	}

	public function cierraSesion(){
		$this->load->library('facebook');
		$this->session->sess_destroy();
    $this->facebook->destroySession();
    $this->googleplus->revokeToken();
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
	public function catalogogastos(){
		$data = array(
			'catgastos'=>$this->m_easyb->getcatgastos(),
			'rubros'=>$this->m_easyb->getrubros()
			);
		$this->load->view('catalogogastos',$data);
	}
	public function gastos(){
		$data = array(
			'gastosgeneral'=>$this->m_easyb->getgastos(),
			'catalogogastos'=>$this->m_easyb->getcatalogogastos()
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
			'detallegastos'=>$this->m_easyb->getdetallegastos($id_rubro)
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
