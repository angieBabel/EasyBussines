<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fbtest extends CI_Controller {

  private $fb;

  public function __construct(){
    parent::__construct();

  //  $this->load->model('m_easyb');
    //$this->load->library('testClass', 'Path\to\your\class');
    //$this->load->library('testClass');
    $this->fb =$this->facebooksdk;
  }

  public function login(){
    $cb= "http://localhost:8080/EasyBussines/index.php/fbtest/callback";
    $url = $this->fb->getLoginUrl($cb);
    echo "<a href='$url'>Login con FB</a>";
  }

  public function callback(){
    $act = $this->fb->getAccessToken();
    $data = $this->fb->getUserData($act);
    print_r($data);
  }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
