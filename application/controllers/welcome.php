<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_easyb');

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function panel()
	{
		$this->load->view('panel');
	}

	public function productos()
	{
		$data = array(
			'productos'=>$this->m_easyb->getproductos()
			);
		$this->load->view('productos',$data);
	}

	public function ventas()
	{
		$data = array(
			'ventas'=>$this->m_easyb->getventas(),
			'adeudos'=>$this->m_easyb->getadeudos()
			);
		$this->load->view('ventas',$data);
	}
	public function gastos()
	{
		$data = array(
			'gastos'=>$this->m_easyb->getgastos()
			);
		$this->load->view('gastos',$data);
	}
	public function razones(){
		$this->load->view('razones');
	}

	public function graficas(){
		$this->load->view('graficas');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
