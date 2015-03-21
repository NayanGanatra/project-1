<?php
 class Captcha_model extends CI_Model
 {
 	private $vals = array();
	private $baseUrl  = 'http://testsite.spcsusa.org/';
    
	private $basePath = './';
	
	private $captchaImagePath = 'images/captcha/';
	private $captchaImageUrl  = 'images/captcha/';
	private $captchaFontPath  = './system/fonts/texb.ttf';
	
	public function __construct($configVal = array())
	{
		parent::__construct();
		
		//$this->load->plugin('captcha_pi');
		$this->load->library('captcha_pi');
		if(!empty($config))
			$this->initialize($configVal);
		else
			$this->vals = array(
								'word'		 	=> '',
								'word_length'	=> 6,
								'img_path'	 	=> $this->basePath . $this->captchaImagePath,
								'img_url'	 	=> $this->baseUrl . $this->captchaImageUrl,
								'font_path'	 	=> $this->captchaFontPath,
								'img_width'	 	=> '150',
								'img_height' 	=> 50,
								'expiration' 	=> 3600
							   );	
	}	
	
	/**
	 * initializes the variables
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @param 	array 	config
	 */		 	
	public function initialize ($configVal = array())
	{
		$this->vals = $configVal;
	} //end function initialize
	
	//---------------------------------------------------------------
	
	/**
	 * generate the captcha
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @return 	array
	 */	
	public function generateCaptcha () 
	{
		$cap = $this->captcha_pi->create_captcha($this->vals);
		return $cap;	
	} //end function generateCaptcha	
 }
?>