<?php 
Class Review extends CI_model
{   
   public function create_review($review_details,$author_id,$book_id,$user_id)
   {
      $review_data = array('content'    => $review_details['review'],
         						 'book_id'    => $book_id,
         						 'user_id'    => $user_id,
         						 'rating'     => $review_details['rating'],
      						 	 'created_at' => date("Y-m-d H:i:s") ,
      						 	 'updated_at' => date("Y-m-d H:i:s")
      			     ) ;
      $review_created =	$this->db->insert('reviews',$review_data);
      return $review_created; 	   
   }

   public function get_all_reviews()
   {
   	$query = $this->db->query("SELECT * from reviews ORDER BY created_at DESC LIMIT 10");
   	return $query->result_array();
   }

   public function get_all_reviews_by_book_id($book_id)
   {
      $query = "SELECT * FROM reviews where book_id = ? ORDER BY created_at DESC";
      return $this->db->query($query,$book_id )->result_array();
   }

   public function get_reviews_by_user($user_id)
   {
      $query = "SELECT * FROM reviews where user_id = ? ORDER BY created_at DESC";
      return $this->db->query($query,$user_id)->result_array();
   }
}