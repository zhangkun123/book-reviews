<?php 
Class User extends CI_model
{
  public function __construct()
  {
    $this->load->library('form_validation');
  }

  public function get_user_with_email($email)
  {
    $user_email = strtolower($email);
    $user_fetch_query = "SELECT * FROM users WHERE username = ?";
    return $this->db->query($user_fetch_query,$user_email)->row_array();
  }

  public function get_user_by_id($id)
  {
    $query = $this->db->get_where('users', array('id' => $id));
    return $query->row_array();
  }

  public function get_all_users()
  {
    $query =  $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
    return $query->result_array();
  }

  public function create_user($user)
  {
   	$input_validation_passed = TRUE; 
   	$data=array();
   	$config = array(
                   array(
                         'field' => 'first_name', 
                         'label' => 'First Name', 
                         'rules' => 'trim|required'
                        ),
                   array(
                         'field' => 'last_name', 
                         'label' => 'Last Name', 
                         'rules' => 'trim|required'
                        ),
                    array(
                         'field' => 'username', 
                         'label' => 'User Name', 
                         'rules' => 'trim|required|valid_email'
                        ),
                   array(
                         'field' => 'password', 
                         'label' => 'Password', 
                         'rules' => 'trim|required|matches[password_conf]'
                        ),   
                   array(
                         'field' => 'password_conf', 
                         'label' => 'Password Confirmation', 
                         'rules' => 'trim|required'
                        )
            );

    $this->form_validation->set_rules($config);
    $get_user_with_email = $this->get_user_with_email($user['username']);

    if ($this->form_validation->run() == FALSE)
    {
      $data["error_message"] = validation_errors();
      $data["user_created"] = FALSE;
    }
    else if($get_user_with_email)
    {
  		$data["error_message"] = "User already exists in DB,Please sign in";
  		$data["user_created"] = FALSE;
    }
    else
    {
  	//Create User
  	$user_data = array(
        					   'first_name'  => $user['first_name'] ,
        					   'last_name'   => $user['last_name'],
        					   'username'    => $user['username'],
        					   'password'    => md5($user['password']),
        					   'created_at'  => date("Y-m-d H:i:s"),
        					   'updated_at'  => date("Y-m-d H:i:s")
				        );
      if($this->db->insert('users', $user_data))
      {
	     	$data["success_message"] = "User created Successfully..Please login!!";
	     	$data["user_created"] = TRUE;  
	    } 
      else
      {
        $data["error_message"] = "User cannot be created,DB issue";
        $data["user_created"] = FALSE;  
      }
    }
    return $data;	
  }

  public function validate_user($user)
  {
    $data   = array();
    $config = array(
                   array(
                         'field' => 'username', 
                         'label' => 'User Name', 
                         'rules' => 'trim|required|valid_email'
                        ),
                   array(
                         'field' => 'password', 
                         'label' => 'Password', 
                         'rules' => 'trim|required' 
                        )        
              );
    $this->form_validation->set_rules($config);
    $get_user_with_email = $this->get_user_with_email($user['username']);
    if ($this->form_validation->run() == FALSE)
    {
      $data["error_message"] = validation_errors();
      $data["is_login"] = FALSE;
    }
    else if(!$get_user_with_email)
    {
      $data["error_message"] = "User not found in DB,Please register";
      $data["is_login"] = FALSE;
    }
    else
    {
      if($get_user_with_email['password'] == md5($user['password']))
      {
        $data["is_login"] = TRUE;
        $data["success_message"] = "Successfully logged in";
      	$current_user = array('user_id'    => $get_user_with_email['id'],
                              'user_name'  => $get_user_with_email['username'],
                              'first_name' => $get_user_with_email['first_name'],
                              'last_name'  => $get_user_with_email['last_name']
                            );
        $this->session->set_userdata("current_user",$current_user); 
      }
      else
      {
      	$data["error_message"] = "User password doesnot match";
        $data["is_login"] = FALSE;	
      }
    }
	  return $data;
  }
}  