<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mi_facebook  extends CI_Controller
{
  public function __construct()
  {
     parent::__construct();
     $this->load->model('m_easyb');
     /*$this->load->helper('url');*/


  }
  public function login(){
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
        $data['logout_url']=site_url('Mi_facebook/logout');
    }else{
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('welcome/panel'),
                'scope' => array("email") ));
    }
    /*print_r($data);*/
    /*redirect('')*/
    $this->load->view('login',$data);
  }

  public function logout(){
     $this->load->library('facebook');
     $this->facebook->destroySession();
     redirect('Mi_facebook/login');

  }
    /*private $appId;
    private $secret;
    public function index()  {
        $this->appId = '1056405014449406 ';
        $this->secret = '99d0c2e16a5cb9ab3fa4aacb1a8444f9 ';
        $fb_config = array(
            'appId' => $this->appId,
            'secret' => $this->secret
        );

        $this->load->library('facebook', $fb_config);

        $user_id = $this->facebook->getUser();
        $token = $this->facebook->getAccessToken();

        if ($user_id) {
            try {
                $data['logout_url'] = $this->facebook->getLogoutUrl();
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'scope' => 'email,name', 'redirect_uri' => ''));
        }
        $data['titulo'] = 'Prueba aplicación facebook con codeigniter';
        //método que creamos en el modelo con una consulta fql
        $data['usuario'] = $this->m_easyb->datos_usuario();
        //print_r($data);
        $this->load->view('loginFB',$data);
    }*/
}
/*fin del controlador facebook.php
*/
