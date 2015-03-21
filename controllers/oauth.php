<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oauth extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbuser');
		$this->load->model('dbheader');
	}
	
	function _remap($method,$other='')
	{		
	//session_start();
	
			if($method == 'facebook')
			{
				// Start Login
				if($this->uri->segment(3) == "login")
				{
					$param['redirect_uri']=site_url("oauth/facebook/fb");
					$param['scope']="email,publish_stream,user_birthday,user_location,user_hometown";
					redirect($this->fb_connect->getLoginUrl($param));
				}
				elseif($this->uri->segment(3) == "fb")
				{
		  				$this->fb();
				}
				elseif($this->uri->segment(3) == "page")
				{
		  				$this->page();
				}
				elseif($this->uri->segment(3) == "validate")
				{
		  				$this->validate();
				}
				elseif($this->uri->segment(3) == "uploadcover")
				{
		  				$this->uploadcover($this->uri->segment(4),$this->uri->segment(5));
				}
			}
	}
	
	function fb() {
	        
	        if (!$this->fb_connect->getUser()) {
				redirect(base_url().'/user/login', 'refresh');
				
	        } else {
	           $fb_uid = $this->fb_connect->user_id;
	           $fb_usr = $this->fb_connect->user;
			   
			   $validate=$this->dbuser->get_user($fb_usr['id']);
			   
			   if(!$validate)
			   {
			   		//if($fb_usr['user_hometown']) { $hometown = $fb_usr['user_hometown'];  } else { $hometown = ""; }
					if(isset($fb_usr['bio'])) { $bio = $fb_usr['bio'];  } else { $bio = ""; }
					if(isset($fb_usr['name'])) { $name = $fb_usr['name'];  } else { $name = ""; }
					if(isset($fb_usr['email'])) { $email = $fb_usr['email'];  } else { $email = ""; }
					if(isset($fb_usr['gender'])) { $gender = $fb_usr['gender'];  } else { $gender = ""; }
					if(isset($fb_usr['birthday'])) { $birthday = $fb_usr['birthday'];  } else { $birthday = ""; }
					if(isset($fb_usr['location'])) { $location = $fb_usr['location']['name'];  } else { $location = ""; }
					if(isset($fb_usr['timezone'])) { $timezone = $fb_usr['timezone'];  } else { $timezone = ""; }
					if(isset($fb_usr['updated_time'])) { $updated_time = $fb_usr['updated_time'];  } else { $updated_time = ""; }
					if(isset($fb_usr['username'])) { $username = $fb_usr['username'];  } else { $username = ""; }
					
			   		$insert_data=array('facebook_id'=>$fb_usr['id'],'name'=>$name,'email'=> $email,'gender'=> $gender,'birthday'=> $birthday,'location'=> $location,'bio'=> $bio,'timezone'=> $timezone,'create'=> date('Y-m-d H:i:s'),'updated_time'=> $updated_time,'username'=> $username);
					$result=$this->dbuser->insert($insert_data);
			   }

			  redirect(base_url(), 'refresh');

	        }
	}
	
	function page($id,$name='')
	{
		
		if (!$this->fb_connect->getUser()) {
			$param['redirect_uri']=base_url()."facebook/page/".$id."/".$name;
			$param['scope']="email,publish_stream,user_birthday,user_location,user_hometown";
	        redirect($this->fb_connect->getLoginUrl($param));
		}
		else
		{
		$this->checkuser();
		$data['title']="Select Page";
		$this->load->view('select_page',$data);
		}
	}
	
	function validate()
	{
	 		   $fb_uid = $this->fb_connect->user_id;
	           $fb_usr = $this->fb_connect->user;
			   
			   $validate=$this->dbuser->get_user($fb_usr['id']);
			   
			   if(!$validate)
			   {
			   		//if($fb_usr['user_hometown']) { $hometown = $fb_usr['user_hometown'];  } else { $hometown = ""; }
					if(isset($fb_usr['bio'])) { $bio = $fb_usr['bio'];  } else { $bio = ""; }
					if(isset($fb_usr['name'])) { $name = $fb_usr['name'];  } else { $name = ""; }
					if(isset($fb_usr['email'])) { $email = $fb_usr['email'];  } else { $email = ""; }
					if(isset($fb_usr['gender'])) { $gender = $fb_usr['gender'];  } else { $gender = ""; }
					if(isset($fb_usr['birthday'])) { $birthday = $fb_usr['birthday'];  } else { $birthday = ""; }
					if(isset($fb_usr['location'])) { $location = $fb_usr['location']['name'];  } else { $location = ""; }
					if(isset($fb_usr['timezone'])) { $timezone = $fb_usr['timezone'];  } else { $timezone = ""; }
					if(isset($fb_usr['updated_time'])) { $updated_time = $fb_usr['updated_time'];  } else { $updated_time = ""; }
					if(isset($fb_usr['username'])) { $username = $fb_usr['username'];  } else { $username = ""; }
					
			   		$insert_data=array('facebook_id'=>$fb_usr['id'],'name'=>$name,'email'=> $email,'gender'=> $gender,'birthday'=> $birthday,'location'=> $location,'bio'=> $bio,'timezone'=> $timezone,'create'=> date('Y-m-d H:i:s'),'updated_time'=> $updated_time,'username'=> $username);
					$result=$this->dbuser->insert($insert_data);
			   }
			   return true;
	}
	
	function uploadcover($id,$name='')
	{
		
		
		if (!$this->fb_connect->getUser()) {
			$param['redirect_uri']=base_url()."oauth/facebook/uploadcover/".$id."/".$name;
			$param['scope']="email,publish_stream,user_birthday,user_location,user_hometown";
	        redirect($this->fb_connect->getLoginUrl($param));
		}
		else
		{

			$this->validate();
			$get_cover = $this->dbheader->getcover($id);
			
			if($get_cover)
			{
				$msg = $this->config->item('fb_msg');
				$photourl = $this->config->item('rootfolderpath')."covers-images/download/".$get_cover->covers_image."";
				$upload_pic = $this->fb_connect->upload_photo($msg,$photourl);
				
				$data['uploaded_cover'] = $upload_pic['id'];
				
				$update_download=array("covers_downloads" => $get_cover->covers_downloads+1);
				$update_download=$this->dbheader->update_cover($update_download,$id);
				redirect(base_url().'covers/'.$get_cover->covers_cat_seo.'/'.$get_cover->covers_seo.'/uploaded/'.$data['uploaded_cover']);
			}
			else
			{
				redirect(base_url());
			}
		}
	}

}