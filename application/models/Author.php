<?php 
Class Author extends CI_model
{
    
   public function get_all_authors()
   {
      $authors = $this->db->get('authors');
      return $authors->result_array();
   }  

   public function create_author($first_name,$last_name)
   {
   		$data = array();
   		$author_data = array(
						   'first_name' => $first_name ,
						   'last_name'  => $last_name ,
						   'created_at' => date("Y-m-d H:i:s"),
						   'updated_at' => date("Y-m-d H:i:s")
			            );
         $author = $this->db->insert('authors', $author_data);
         $get_author = $this->db->get_where('authors', array('first_name' => $first_name ,
                                                             'last_name' => $last_name ));
         $author = $get_author->row_array();

   	   if($author['id']){
   	   	$data["author_id"] = $author['id'];
   	   }
   	   else{
   	      $data["author_id"] = NULL;
   	   }
      return $data; 
   }
}