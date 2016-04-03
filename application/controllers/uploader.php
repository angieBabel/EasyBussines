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
  public function altausuario()
  {
    $this->load->view('index');
  }

  public function altaproducto()
  {
    $this->load->view('index');
  }

  public function altaventa()
  {
    $this->load->view('index');
  }

  public function altarubro()
  {
    $this->load->view('index');
  }

  public function altaconcepto()
  {
    $this->load->view('index');
  }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
