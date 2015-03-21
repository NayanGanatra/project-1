<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ca extends CI_Controller {

function __construct()
	{
		parent::__construct();

		$this->load->model('dbca');
		$this->load->model('dbchapter');
		$this->load->model('dbheader');
		$this->load->library('email');
		$this->load->library('parser');
		
		$login = $this->session->userdata('user_email');
		
		if(!$login)
		{
			redirect(base_url('user/login.html'));
		}
		
		$current_user = $this->dbheader->user_details($login);

		if($current_user->mm_type == 0)
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
			redirect(base_url('user/account.html'));
		}
	}
	/* News */
	function news()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['chapter'] = $this->dbchapter->chapter_byid($data['user']->mm_chapter_id);
		$num_rec = $this->dbca->count_ch_news($data['user']->mm_chapter_id);
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'ca/news/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbca->get_all_news($segment,$config['per_page'],$data['user']->mm_chapter_id);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'News Management';
			$data['sub_title'] = 'Add/Edit/Delete News';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_news',$data);
	}
	
	function edit_news($id,$title='')
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['query'] = $this->dbca->get_news($id,$data['user']->mm_chapter_id);
		
		if(!$data['query'])
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
			redirect(base_url('user/account.html'));
		}
		
		$this->form_validation->set_rules('news_title', 'News Title', 'required');
		$this->form_validation->set_rules('news_content', 'News Content', 'required');
		$this->form_validation->set_rules('news_create', 'Date', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'news_title'=>$this->input->post('news_title'),
				'news_content'=>$this->input->post('news_content'),
				'news_create'=>$this->input->post('news_create')
				);
				$result=$this->dbca->edit_news($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/news');
		}
		
		$data['title'] = 'News Management';
		$data['sub_title'] = 'Edit News';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_news_edit',$data);
	}
	
	function add_news()
	{	
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$this->form_validation->set_rules('news_title', 'News Title', 'required');
		$this->form_validation->set_rules('news_content', 'News Content', 'required');
		$this->form_validation->set_rules('news_create', 'Date', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'news_title'=>$this->input->post('news_title'),
				'news_content'=>$this->input->post('news_content'),
				'news_create'=>$this->input->post('news_create'),
				'news_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->add_news($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/news');
		}
		
		$data['title'] = 'News Management';
		$data['sub_title'] = 'Add News';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_news_add',$data);
	}
	
	function delete_news($id)
	{
		$result=$this->dbca->delete_news($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('ca/news'));
			}
	}
	/* Events */
	function events()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['chapter'] = $this->dbchapter->chapter_byid($data['user']->mm_chapter_id);
		$num_rec = $this->dbca->count_ch_events($data['user']->mm_chapter_id);
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'ca/events/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbca->get_all_events($segment,$config['per_page'],$data['user']->mm_chapter_id);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'Events Management';
			$data['sub_title'] = 'Add/Edit/Delete Events';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_events',$data);
	}
	
	function edit_event($id,$title='')
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['query'] = $this->dbca->get_event($id,$data['user']->mm_chapter_id);
		
		if(!$data['query'])
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
			redirect(base_url('user/account.html'));
		}
		
		$this->form_validation->set_rules('event_name', 'Event Title', 'required');
		$this->form_validation->set_rules('event_location', 'Event Location', 'required');
		$this->form_validation->set_rules('event_date_time', 'Date and Time', 'required');
		$this->form_validation->set_rules('event_description', 'Event Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'event_name'=>$this->input->post('event_name'),
				'event_location'=>$this->input->post('event_location'),
				'event_description'=>$this->input->post('event_description'),
				'event_status'=>$this->input->post('event_status'),
				'event_date_time'=>$this->input->post('event_date_time'),
				'event_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->edit_event($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/events');
		}
		
		$data['title'] = 'Events Management';
		$data['sub_title'] = 'Edit Event';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_event_edit',$data);
	}

	function add_event()
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$this->form_validation->set_rules('event_name', 'Event Title', 'required');
		$this->form_validation->set_rules('event_location', 'Event Location', 'required');
		$this->form_validation->set_rules('event_date_time', 'Date and Time', 'required');
		$this->form_validation->set_rules('event_description', 'Event Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'event_name'=>$this->input->post('event_name'),
				'event_location'=>$this->input->post('event_location'),
				'event_description'=>$this->input->post('event_description'),
				'event_status'=>$this->input->post('event_status'),
				'event_date_time'=>$this->input->post('event_date_time'),
				'event_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->add_event($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/events');
		}
		
		$data['title'] = 'Event Management';
		$data['sub_title'] = 'Add Event';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_event_add',$data);
	}
	
	function event_details()
	{
		$this->form_validation->set_rules('page_comments', 'Comment Required', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['chapter'] = $this->dbchapter->chapter($this->uri->segment(3));
		
		$data['query'] = $this->dbchapter->event_byid($this->uri->segment(4));
		
		if ($this->form_validation->run() == TRUE)
		{
			if($this->input->post('user_id'))
			{
				$dataB=array(
				'msg'=>$this->input->post('page_comments'),
				'msg_time'=>date('Y-m-d H:i:s'),
				'msg_frm'=>0,
				'msg_to'=>$this->input->post('user_id'),
				'msg_to_ch_id'=>$data['query']->event_ch_id,
				'event_id'=>$data['query']->event_id,
				'ei_id'=>$this->input->post('ei_id')
				);
			}
			else
			{
				$dataB=array(
				'msg'=>$this->input->post('page_comments'),
				'msg_time'=>date('Y-m-d H:i:s'),
				'msg_frm'=>0,
				'msg_to_ch_id'=>$data['query']->event_ch_id,
				'event_id'=>$data['query']->event_id,
				'ei_id'=>0
				);
			}
			$resultB=$this->dbca->insert_event_inv_msg($dataB);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Message successfully sent.');
			redirect($this->uri->uri_string());
		}
		
		$data['title'] = $data['query']->event_name;
		$data['sub_title'] = 'Event Date and Time: '.$data['query']->event_date_time;
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_event_details',$data);
	}
	
	function delete_event($id)
	{
		$result=$this->dbca->delete_event($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('ca/events'));
			}
	}
	
	function invite()
	{
		$settings = $this->dbheader->get_setting();
		$id = $this->uri->segment(4);
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['queryC'] = $this->dbca->get_event($id,$data['user']->mm_chapter_id);
		
		if(!$data['queryC'])
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
			redirect(base_url('user/account.html'));
		}
		
		$this->form_validation->set_rules('mm_id[]', 'Members Checkbox', 'required');
		$this->form_validation->set_rules('subject', 'Email Subject', 'required');
		$this->form_validation->set_rules('event_msg', 'Event Message', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline error">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$mm_ids = $this->input->post('mm_id');
			
			/*$mm_emails = array();
			$unique_keys = array();*/
			
			for($i=0;$i < count($mm_ids); $i++)
			{
				$unique_key = substr(md5(rand(0, 1000000)), 0, 35);
				
				$get_mm_email = $this->dbca->get_member_email_by_mm_id($mm_ids[$i]);

				/*array_push($mm_emails, $get_mm_email->mm_email);
				array_push($unique_keys, $unique_key);*/
				
				$check_event_invitation = $this->dbca->check_event_invitation($mm_ids[$i],$id);
				
				if($check_event_invitation)
				{
				$dataB=array(
					'email_status'=>$check_event_invitation->email_status+1
					);
				$resultB=$this->dbca->edit_event_invitation($dataB,$check_event_invitation->ei_id);
				}
				else
				{
					$dataB=array(
					'mm_id'=>$mm_ids[$i],
					'event_id'=>$id,
					'email_status'=>1,
					'unique_number'=>$unique_key,
					'create_time'=>date('Y-m-d H:m:s')
					);
				$resultB=$this->dbca->insert_event_invitation($dataB);
				}
				
				$config['mailtype'] = 'html';
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['bcc_batch_mode'] = TRUE;
				
				$this->email->initialize($config);
	
				$this->email->from($settings->email);
				$this->email->to($get_mm_email->mm_email);
				
				$this->email->subject($this->input->post('subject'));
				
				$email_link = base_url('user/invitation_details/'.$id.'/'.$unique_key);
				
				$final_message = array('link' => $email_link,'message' => $this->input->post('event_msg'),'site_email' => $settings->email, 'sitename'=>$settings->sitename);
				
				$this->email->message($this->parser->parse('invite_parser', $final_message , TRUE));
				
				$this->email->send();
				//echo $this->email->print_debugger();	
				
			}
			
			$dataA=array(
				'event_id'=>$id,
				'event_msg'=>$this->input->post('event_msg'),
				'event_subject'=>$this->input->post('subject'),
				'mm_ca_id'=>$data['user']->mm_chapter_id,
				'em_create'=>date('Y-m-d H:i:s')
				);
				$resultA=$this->dbca->insert_event_msg($dataA);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Invitation email sent to members!');
				
				redirect(base_url('ca/events'));
		}
		
		$data['get_state'] = $this->dbca->get_state_from_ch_id($data['user']->mm_chapter_id);
		
		$data['query'] = $this->dbca->get_members($data['user']->mm_chapter_id);
		
		$data['title'] = 'Invitation for Event';
		$data['sub_title'] = 'Send invitation to members for '.$data['queryC']->event_name.' Event';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_members',$data);
	}
	/* Media */
	function media()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$num_rec = $this->dbca->count_ch_media($data['user']->mm_chapter_id);
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'ca/media/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbca->get_all_media($segment,$config['per_page'],$data['user']->mm_chapter_id);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'Media Management';
			$data['sub_title'] = 'Add/Edit/Delete Media';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_media',$data);
	}
	
	function add_media()
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');
		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if($this->input->post('media_type') == 1)
		{
			$this->form_validation->set_rules('media_data', 'Video Embed URL', 'required');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($this->input->post('media_type') == 0)
			{
				// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('photo'))
				{
					$filename="";
					$thumb = '';
				}
				else
				{
					$filename=$this->upload->file_name;
					
					$thumb = $this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(600,450,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/big/".$this->upload->file_name,$overwrite=TRUE);
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize_crop(140,105)
					->save($this->config->item('rootfolderpath')."images/media/thumbs/".$this->upload->file_name,$overwrite=TRUE);
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);			
				}
				// image upload end
			}
			else
			{
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('thumb'))
				{
					$thumb = '';
				}
				else
				{
					$thumb = $this->upload->file_name;
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(140,105,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/thumb/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);	
				}
				$filename = $this->input->post('media_data');
			}
			
				$data=array(
				'media_title'=>$this->input->post('media_title'),
				'media_data'=>$filename,
				'media_thumb'=>$thumb,
				'media_type'=>$this->input->post('media_type'),
				'media_date'=>date('Y-m-d'),
				'media_status'=>1,
				'media_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->add_media($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/media');
		}
		
		$data['title'] = 'Media Management';
		$data['sub_title'] = 'Add Photo or Video';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_media_add',$data);
	}
	
	function edit_media($id,$title='')
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['get_media'] = $this->dbca->get_media($id,$data['user']->mm_chapter_id);
		
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');
		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if($this->input->post('media_type') == 1)
		{
			$this->form_validation->set_rules('media_data', 'Video Embed URL', 'required');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($this->input->post('media_type') == 0)
			{
				// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('photo'))
				{
					$filename = $this->input->post('old_media_data');
					$thumb = $this->input->post('old_media_thumb');
				}
				else
				{
	
					$filename=$this->upload->file_name;
					
					$thumb = $this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(600,450,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/big/".$this->upload->file_name,$overwrite=TRUE);
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize_crop(140,105)
					->save($this->config->item('rootfolderpath')."images/media/thumbs/".$this->upload->file_name,$overwrite=TRUE);
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);			
				}
				// image upload end
			}
			else
			{
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('thumb'))
				{
					$thumb = $this->input->post('old_media_thumb');
					$filename = $this->input->post('old_media_data');
				}
				else
				{
					$thumb = $this->upload->file_name;
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(140,105,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/thumb/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);
					
					$filename = $this->input->post('media_data');
				}
				
			}
			
				$data=array(
				'media_title'=>$this->input->post('media_title'),
				'media_data'=>$filename,
				'media_thumb'=>$thumb,
				'media_type'=>$this->input->post('media_type'),
				'media_date'=>date('Y-m-d'),
				'media_status'=>1,
				'media_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->edit_media($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/media');
		}
		
		$data['title'] = 'Media Management';
		$data['sub_title'] = 'Edit Photo or Video';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_media_edit',$data);
	}
	
	function delete_media($id)
	{
		$result=$this->dbca->delete_media($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('ca/media'));
			}
	}
	
	///////// Committee ////////////
	function committee()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$num_rec = $this->dbca->count_ch_cm($data['user']->mm_chapter_id);
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'ca/committee/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 50;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbca->get_all_cm($segment,$config['per_page'],$data['user']->mm_chapter_id);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'Committee';
			$data['sub_title'] = 'Add/Edit/Delete Committee Members';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_cm',$data);
	}
	
	function add_committee()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$this->form_validation->set_rules('cm_mm_id', 'Select Member', 'required');
		$this->form_validation->set_rules('cm_position', 'Position', 'required');
		$this->form_validation->set_rules('cm_year', 'Year', 'required');
		$this->form_validation->set_rules('cm_status', 'Status', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'cm_mm_id'=>$this->input->post('cm_mm_id'),
				'cm_position'=>$this->input->post('cm_position'),
				'cm_year'=>$this->input->post('cm_year'),
				'cm_order'=>$this->input->post('cm_order'),
				'cm_status'=>$this->input->post('cm_status'),
				'cm_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->add_cm($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/committee');
		}
		
		$data['title'] = 'Committee Members';
		$data['sub_title'] = 'Add Commitee Member';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_cm_add',$data);
	}
	
	function edit_committee($id,$title='')
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['get_cm'] = $this->dbca->get_cm($id,$data['user']->mm_chapter_id);
		
		$this->form_validation->set_rules('cm_mm_id', 'Select Member', 'required');
		$this->form_validation->set_rules('cm_position', 'Position', 'required');
		$this->form_validation->set_rules('cm_year', 'Year', 'required');
		$this->form_validation->set_rules('cm_status', 'Status', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'cm_mm_id'=>$this->input->post('cm_mm_id'),
				'cm_position'=>$this->input->post('cm_position'),
				'cm_year'=>$this->input->post('cm_year'),
				'cm_order'=>$this->input->post('cm_order'),
				'cm_status'=>$this->input->post('cm_status'),
				'cm_ch_id'=>$data['user']->mm_chapter_id
				);
				$result=$this->dbca->edit_cm($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/committee');
		}
		
		$data['title'] = 'Committee';
		$data['sub_title'] = 'Edit Committee Member';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_cm_edit',$data);
	}
	
	function delete_committee($id)
	{
		$result=$this->dbca->delete_cm($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('ca/committee'));
			}
	}
	
	
	function add_page()
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['chapter'] = $this->dbchapter->chapter_byid($data['user']->mm_chapter_id);
		
		$this->form_validation->set_rules('page_title', 'Page Title', 'required');
		$this->form_validation->set_rules('sub_title', 'Sub Title', '');
		$this->form_validation->set_rules('page_menu_name', 'Menu Name', 'required');
		$this->form_validation->set_rules('page_content', 'Page Content', 'required');
		$this->form_validation->set_rules('page_seo', 'SEO URL', 'required|callback_checkseo');
		$this->form_validation->set_rules('page_order', 'Page Order', '');
		$this->form_validation->set_rules('page_status', 'Page Status', 'required');
		$this->form_validation->set_rules('page_ch_id', 'Chapter ID', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'page_title'=>$this->input->post('page_title'),
				'sub_title'=>$this->input->post('sub_title'),
				'page_menu_name'=>$this->input->post('page_menu_name'),
				'page_content'=>$this->input->post('page_content'),
				'page_seo'=>friendlyURL($this->input->post('page_seo')),
				'page_order'=>$this->input->post('page_order'),
				'page_status'=>$this->input->post('page_status'),
				'page_ch_id'=>$this->input->post('page_ch_id')
				);
				$result=$this->dbca->add_page($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'ca/pages');
		}
		
		$data['title'] = 'Page Management';
		$data['sub_title'] = 'Add Page';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('ca_page_add',$data);
	}
	
	function pages()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['chapter'] = $this->dbchapter->chapter_byid($data['user']->mm_chapter_id);
		
		$num_rec = $this->dbca->count_ch_pages($data['user']->mm_chapter_id);
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'ca/pages/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 20;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbca->get_all_pages($segment,$config['per_page'],$data['user']->mm_chapter_id);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'Pages Management';
			$data['sub_title'] = 'Add/Edit/Delete Pages';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_pages',$data);
	}
	
	function edit_page()
	{
		
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['chapter'] = $this->dbchapter->chapter_byid($data['user']->mm_chapter_id);
		
		$data['page'] = $this->dbca->get_page($this->uri->segment(3),$data['user']->mm_chapter_id);
		
		$id = $this->uri->segment(3);
		
		if($data['page'])
		{
			$this->form_validation->set_rules('page_title', 'Page Title', 'required');
			$this->form_validation->set_rules('sub_title', 'Sub Title', '');
			$this->form_validation->set_rules('page_menu_name', 'Menu Name', 'required');
			$this->form_validation->set_rules('page_content', 'Page Content', 'required');
			$this->form_validation->set_rules('page_seo', 'SEO URL', 'required|callback_checkseoedit');
			$this->form_validation->set_rules('page_order', 'Page Order', '');
			$this->form_validation->set_rules('page_status', 'Page Status', 'required');
			$this->form_validation->set_rules('page_ch_id', 'Chapter ID', 'required');
			$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
			
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
					$data=array(
					'page_title'=>$this->input->post('page_title'),
					'sub_title'=>$this->input->post('sub_title'),
					'page_menu_name'=>$this->input->post('page_menu_name'),
					'page_content'=>$this->input->post('page_content'),
					'page_seo'=>friendlyURL($this->input->post('page_seo')),
					'page_order'=>$this->input->post('page_order'),
					'page_status'=>$this->input->post('page_status'),
					'page_ch_id'=>$this->input->post('page_ch_id')
					);
					$result=$this->dbca->edit_page($data,$id);
					
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
					
					redirect(base_url().'ca/pages');
			}
			
			$data['title'] = 'Page Management';
			$data['sub_title'] = 'Add Page';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('ca_page_edit',$data);
		}
		else
		{
			
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'Page Not Found!');
			redirect(base_url().'ca/pages');
		}
	}
	
	function checkseoedit($seo)
	{
		
		$query = $this->dbca->check_seo_edit(friendlyURL($seo),$this->uri->segment(3));
		if ($query)
		{
			$this->form_validation->set_message('checkseoedit', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function checkseo($seo)
	{
		
		$query = $this->dbca->check_seo(friendlyURL($seo));
		if ($query)
		{
			$this->form_validation->set_message('checkseo', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}