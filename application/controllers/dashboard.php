<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Dashboard extends Main {
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->Model('User');
		$this->load->Model('Review');
		$this->load->Model('Book');
		if(! $this->is_login())
		{
			$this->session->set_flashdata("error_message","Please login");
			redirect(base_url('/'));
		} 
		$this->load->Model("Author");
	}

	public function index()
	{
		$recent_book_reviews = $this->Review->get_all_reviews();
		$all_books = $this->Book->get_all_books();
		$all_users = $this->User->get_all_users();
		$this->load->view("dashboard/index", array('current_user'   => $this->current_user,
												   'recent_reviews' => $recent_book_reviews,
												   'all_books'      => $all_books,
												   'all_users'      => $all_users
												   ) 
						 );
	}

	public function add_new_book()
	{
		$authors = $this->Author->get_all_authors();
		$this->load->view ( "dashboard/add_new_book",array('authors' => $authors ) );
	}
	
	public function create_book_and_review()
	{
		$review_details = $this->input->post(); 
		$review_created = FALSE;
		//If its a new author
		if($review_details['new_author'])
		{
			$author_name = explode(' ', $review_details['new_author']);
			$author_first_name = $author_name[0];
			$author_last_name = $author_name[1];
			$author_created = $this->Author->create_author($author_first_name, $author_last_name);
			//Check if author record is created	   	
			if($author_created)
			{
				$author_id = $author_created['author_id'];
			}
		}
		//for existing author
		else
		{
			$author_id = $review_details['book_author'];
		}

		$book_created = $this->Book->create_book($review_details, $author_id);
		$book_id = $book_created;
		$current_user = $this->current_user; 
		$user_id = $current_user['user_id'];

    	if($book_created)
		{
			$review_created = $this->Review->create_review($review_details, $author_id,$book_id ,$user_id);
			if($review_created)
			{
				$this->session->set_flashdata("success_message","Review created for the new book");
				redirect(base_url('/dashboard/index'));
			}
		}	
	}

	public function create_review($book_id,$author_id)
	{
		$user = $this->current_user;
		$user_id = $user['user_id'];
		$review_created = $this->Review->create_review($this->input->post(), $author_id,$book_id ,$user_id);

		if($review_created)
		{
			$this->session->set_flashdata("success_message","Review created for the new book");
		}
		else{
			$this->session->set_flashdata("error_message","Review cannot be created");
		}
		redirect(base_url('/dashboard/show_book/'.$book_id));
	}
	public function show_book($id)
	{

		$book = $this->Book->get_books_by_id($id);
		$all_authors = $this->Author->get_all_authors();
		$all_users = $this->User->get_all_users();
		$all_reviews_by_book = $this->Review->get_all_reviews_by_book_id($id);
		//var_dump($all_reviews_by_book);
		$this->load->view("dashboard/show_book",  
								array('book_details'         => $book ,
									  'all_authors'          => $all_authors,
									  'all_reviews_by_book'  => $all_reviews_by_book,
									  'all_users'            => $all_users
									  )
						);
	}
	 
	public function show_user($id)
	{
		$user = $this->User->get_user_by_id($id);
		$all_books = $this->Book->get_all_books();
		$reviews_created_by_user = $this->Review->get_reviews_by_user($id);
		$books_reviewed_by_user = $this->Book->get_books_by_user_id($id);
		$this->load->view('dashboard/show_user' ,
						   array('user_details' 		   => $user ,
								 'books_reviewed_by_user'  => $books_reviewed_by_user,
								 'all_books'               => $all_books
								)	);
	}

	public function display_all_books()
	{
		$all_books = $this->Book->get_all_books();
		$all_authors = $this->Author->get_all_authors();
		$this->load->view('dashboard/display_all_books' ,
			               array( 'all_books'    => $all_books,
			               		  'all_authors'	 => $all_authors
			               	  )  );
	}

	public function display_all_reviews()
	{
		$all_reviews = $this->Review->get_all_reviews();
		$all_books = $this->Book->get_all_books();
		$all_users = $this->User->get_all_users();
		$this->load->view("dashboard/display_all_reviews", 
											array('current_user' => $this->current_user,
		                                           'all_reviews' => $all_reviews,
		                                           'all_books'	 => $all_books,
		                                           'all_users'   => $all_users
		                                           ) 
		                 );

	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata("error_message","Logged Out successfully");
		redirect(base_url('/'));
	}
}