<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Access extends Main 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->Model("User");
		//$this->output->enable_profiler();
	}
	public function index()
	{
		if($this->is_login())
		{
			redirect(base_url('dashboard/index'));
		}
		else
		{
			$this->load->view("access/index");
		}
		
	}

	public function register()
	{
		if($this->input->post("form_action")=="Register")
		{
			$user_info    = $this->input->post(null,true);
			$user_created = $this->User->create_user($user_info);
			if($user_created["user_created"]){
				 $this->session->set_flashdata('success_message',$user_created['success_message']);
			}
			else{
				 $this->session->set_flashdata('error_message',  $user_created['error_message']);
			}
		}
		redirect(base_url('/'));	
	}
	public function login()
	{
		if($this->input->post("form_action") == "Login")
		{
			$user_info = $this->input->post(null,true);
			$user_validation = $this->User->validate_user($user_info);
			if($user_validation["is_login"])
			{
				 $this->session->set_flashdata('success_message', $user_validation["success_message"]);	
				 redirect(base_url('/dashboard/index'));
			}
			else
			{
				 $this->session->set_flashdata('error_message', $user_validation["error_message"] );
				 redirect(base_url('/'));
			}
		}
	   	
	}
}