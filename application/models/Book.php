<?php 
Class Book extends CI_model
{   
  public function create_book($review_details,$author_id)
  {
    $book_data = array('title'      => $review_details['book_title'],
                       'author_id'  => $author_id,
                       'created_at' => date("Y-m-d H:i:s"),
                       'updated_at' => date("Y-m-d H:i:s")
                      );
    $book_created =	$this->db->insert('books', $book_data); 
    $get_book = $this->db->get_where('books', array('title'=>$review_details['book_title']));
    $book = $get_book->row_array();
    $book_id = $book['id']; 
    return $book_id;
  }

  public function get_all_books(){
    $query = $this->db->query("SELECT * FROM books ORDER BY created_at DESC");
    return $query->result_array();
  }

  public function get_books_by_id($id)
  {
    $query = $this->db->get_where('books', array('id' => $id));
    return $query->row_array(); 
  }

  public function get_books_by_user_id($user_id)
  {
    $query = "SELECT distinct(books.id), books.title
              FROM books 
              JOIN reviews ON books.id = reviews.book_id
              JOIN users   ON users.id = reviews.user_id 
              WHERE users.id = ? "; 
    return ($this->db->query($query,$user_id)->result_array()); 
  }

}