<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Facebook extends CI_Controller {

    private $fb;
  public  function __construct(){
    parent::__construct();
    $this->load->library("facebooksdk");
    $this->fb = $this->facebooksdk;
  }

  public function login(){
    $cb = "http://localhost:8080/EasyBussines/index.php/facebook/callback";
    $url= $this->fb->getLoginUrl($cb);
    echo "<a href='$url'>Login con FB </a>";
  }
  public function test(){
    echo "test";
  }
  public function callback(){
    $act = $thi->fb->getAccessToken();
    $data= $this->fb->getUserData($act);
    print_r($data);
  }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
