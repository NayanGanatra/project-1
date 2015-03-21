<?php
	include(APPPATH.'libraries/facebook.php');
 
	class Fb_connect extends Facebook{
 
		//declare public variables
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		public $fbLoginURL 	= "";
		public $fbLogoutURL = "";
 
		public $fb 			= TRUE;
		public $fbSession	= TRUE;
		public $appkey		= 0;
 
		//constructor method.
		public function __construct()
		{
                    $CI = & get_instance();
                    $CI->config->load("facebook",TRUE);
                    $config = $CI->config->item('facebook');
                    parent::__construct($config);
                    $this->user_id = $this->getUser(); // New code
 
                    $me = null;
                    if ($this->user_id) {
                        try {
                            $me = $this->api('/me');
                            $this->user = $me;
                            } catch (FacebookApiException $e) {
                                error_log($e);
                            }
			}
			
			// login or logout url will be needed depending on current user state.
			//(if using the javascript api as well, you may not need these.)
			if ($me) {
				$this->fbLogoutURL = $this->getLogoutUrl();
			} else {
				$this->fbLoginURL = $this->getLoginUrl();
			}	
		} //end Fb_connect() function
		
				function post_to_wall($message,$link="",$photourl="")
                {
                    if($this->fbSession)
                    {
                        $param = array('message'=>$message,'cb' => '');
                        if($photourl!="")
                            $param["picture"] = $photourl;
                        if($link!="")
                            $param["link"] = $link;
                        $posts = $this->api('/me/feed','post',$param);
                        return TRUE;
                    }
                    else
                    {    
                        return FALSE;
                    }
                }
				
				function upload_photo($message,$photourl="")
                {
                    if($this->fbSession)
                    {
						$this->setFileUploadSupport(true);
                        $param = array('message'=>$message);
                        if($photourl!="")
                            $param["image"] = '@' . $photourl;
                        $posts = $this->api('/me/photos','post',$param);
						
						/*print_r($posts);
						echo $posts['id'];*/

                        return $posts;
                    }
                    else
                    {    
                        return FALSE;
                    }
                }
 
	} // end class