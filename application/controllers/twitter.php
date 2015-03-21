<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbheader');
		$this->load->library('twitter_lib');
	}
	
	function index()
	{		
		$tmhOAuth = new tmhOAuth(array(
		  'consumer_key'    => $this->config->item('consumer_key'),
		  'consumer_secret' => $this->config->item('consumer_key_secret'),
		));
		
		$here = $this->twitter_lib->php_self();
		//session_start();
		
		function outputError($tmhOAuth) {
		  echo 'Error: ' . $tmhOAuth->response['response'] . PHP_EOL;
		  tmhUtilities::pr($tmhOAuth);
		}
		
		// reset request?
		if (isset($_REQUEST['wipe'])) {
		  session_destroy();
		  header("Location: {$here}");
		
		// already got some credentials stored?
		} elseif ( isset($_SESSION['access_token']) ) {
		  $tmhOAuth->config['user_token']  = $_SESSION['access_token']['oauth_token'];
		  $tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];
		
		  $code = $tmhOAuth->request('GET', $tmhOAuth->url('1/account/verify_credentials'));
		  if ($code == 200) {
			$resp = json_decode($tmhOAuth->response['response']);
			echo $resp->screen_name;
			//print_r($resp);
		  } else {
			outputError($tmhOAuth);
		  }
		// we're being called back by Twitter
		} elseif (isset($_REQUEST['oauth_verifier'])) {
		  $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
		  $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];
		
		  $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array(
			'oauth_verifier' => $_REQUEST['oauth_verifier']
		  ));
		
		  if ($code == 200) {
			$_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
			unset($_SESSION['oauth']);
			header("Location: {$here}");
		  } else {
			outputError($tmhOAuth);
		  }
		// start the OAuth dance
		} elseif ( isset($_REQUEST['authenticate']) || isset($_REQUEST['authorize']) ) {
		  $callback = isset($_REQUEST['oob']) ? 'oob' : $here;
		
		  $params = array(
			'oauth_callback'     => $callback
		  );
		
		  if (isset($_REQUEST['force_write'])) :
			$params['x_auth_access_type'] = 'write';
		  elseif (isset($_REQUEST['force_read'])) :
			$params['x_auth_access_type'] = 'read';
		  endif;
		
		  $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);
		
		  if ($code == 200) {
			$_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
			$method = isset($_REQUEST['authenticate']) ? 'authenticate' : 'authorize';
			$force  = isset($_REQUEST['force']) ? '&force_login=1' : '';
			$authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}{$force}";
			echo '<p>To complete the OAuth flow follow this URL: <a href="'. $authurl . '">' . $authurl . '</a></p>';
		  } else {
			outputError($tmhOAuth);
		  }
		}

	}
	
	function tweet()
	{
		$tmhOAuth = new tmhOAuth(array(
		  'consumer_key'    => $this->config->item('consumer_key'),
		  'consumer_secret' => $this->config->item('consumer_key_secret'),
		  'user_token'      => $_SESSION['access_token']['oauth_token'],
		  'user_secret'     => $_SESSION['access_token']['oauth_token_secret'],
		));

		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		  'status' => 'My Twitter Message'
		));
		
		if ($code == 200) {
		  $this->twitter_lib->pr(json_decode($tmhOAuth->response['response']));
		} else {
		  $this->twitter_lib->pr($tmhOAuth->response['response']);
		}
	}
	
	function images()
	{
		$tmhOAuth = new tmhOAuth(array(
		  'consumer_key'    => $this->config->item('consumer_key'),
		  'consumer_secret' => $this->config->item('consumer_key_secret'),
		  'user_token'      => $_SESSION['access_token']['oauth_token'],
		  'user_secret'     => $_SESSION['access_token']['oauth_token_secret'],
	  ));
	
	$path = 'D:\ami_wall\fbcover\23sep\Pink_Love.jpg';
	$meta = getimagesize($path);
	
	  // note the type and filename are set here as well
	  $params = array(
		//'image' => "@{$_FILES['image']['tmp_name']};type={$_FILES['image']['type']};filename={$_FILES['image']['name']}",
		'banner' => "@".$path.";type=".$meta['mime'].";filename=Pink_Love.jpg",
	  );
	  print_r($params);
	$_POST['method'] = 'update_profile_background_image'; //update_profile_image //update_profile_background_image
	  // if we are setting the background we want it to be displayed
	  if ($_POST['method'] == 'update_profile_image')
		$params['use'] = 'true';

	  //$code = $tmhOAuth->request('POST', $tmhOAuth->url("1/account/{$_POST['method']}"),
	  $code = $tmhOAuth->request('POST', $tmhOAuth->url("1/account/update_profile_banner"), // for banner
		$params,
		true, // use auth
		true  // multipart
	  );
	
	  if ($code == 200) {
		$this->twitter_lib->pr(json_decode($tmhOAuth->response['response']));
	  }
	    $this->twitter_lib->pr(htmlentities($tmhOAuth->response['response']));
	}
}