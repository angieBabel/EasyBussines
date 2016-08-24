<?php

	if(!session_id()){
		session_start();
	}

	require_once("Facebook/autoload.php");

	class FacebookSDK{

		protected $fb;
		protected $helper;

		public function __construct(){

			$this->fb = new Facebook\Facebook([
				  'app_id' => '535206340011165',
				  'app_secret' => 'a0bfd8bb8b296ce5fa434792fd024550',
				  'default_graph_version' => 'v2.5',
				]);
			$this->helper = $this->fb->getRedirectLoginHelper();

		}

		function getLoginUrl($callback_url){

			$permissions = ['email']; // optional
			$loginUrl = $this->helper->getLoginUrl($callback_url, $permissions);
			return $loginUrl;
		}


		function getAccessToken(){
			try {
			  $accessToken = $this->helper->getAccessToken();
			  return $accessToken;
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
		}


		function getUserData($access_token){
			$this->fb->setDefaultAccessToken($access_token);

			try {
			  $response = $this->fb->get('/me?fields=name,first_name,last_name,email');
			  $plainOldArray = $response->getDecodedBody();

			  //print_r($plainOldArray);
			  //$userNode = $response->getGraphUser();
			  //echo $userNode->;
			  return $plainOldArray;
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

		}


	}

	?>
