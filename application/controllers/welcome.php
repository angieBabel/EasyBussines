<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_easyb');
		$this->load->library('session');

	}


	/*public function index(){ //Pagina principal
		if ($this->validaSesion()) {
			redirect('welcome/amiental');
		}else{
			$this->load->view('login');
		}
	}

	function validaSesion(){
		if ($this->session->userdata('email') != '') {
            return true;
        }
        else {
            return false;
        }
	}

	function cierraSesion(){
		$this->session->sess_destroy();
		redirect('welcome/ambiental');
	}
*/
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
	public function altaproductos()
	{
		$this->load->view('altaproductos');
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
			'gastosgeneral'=>$this->m_easyb->getgastos()
			);
		$this->load->view('gastos',$data);
	}

	/*public function desactivaProducto($id)
  {
    $id = $_GET['id'];
    $this->m_lyons->desactivaproducto($id);
    redirect('welcome/matProductos');
  }*/
	public function getdetallegastos()
	{
		$id_rubro = $_GET['id_rubro'];
		$data = array(
			'detallegastos'=>$this->m_easyb->getdetallegastos($id_rubro)
			);
		$this->load->view('gastos_detalle',$data);
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
