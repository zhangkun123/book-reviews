<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public $current_user;

	public function __construct()
	{
		parent::__construct();
		$this->current_user = $this->session->userdata("current_user");
		$current_user = $this->current_user;
		$user_id = $current_user['user_id'];
		$this->load->view("partial/header",array('current_user' => $user_id));
	}

    public function is_login()
    {
    	if($this->current_user)
    	{
    		return true;
    	}

    } 
}
//end of main controller