<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Books</title>
	<link rel="stylesheet" type="text/css" 
	      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script type="text/javascript" 
	        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
	</script>
	<style type="text/css">
		body { padding-top: 10px; }
		footer{
				padding: 10px;
				margin: 30px;
				background: #ccc;
				border-radius: 10px;
		       }
		footer p{
			font-size: 15px;
			font-weight: bold;
			font-style: italic;
			font-family: Verdana, Geneva, sans-serif;
		}
		.action_form .btn
		{
			margin: 5px;
		}
	</style>
</head>
<body class="container">
	<div class="row">
		 <div class="col-md-10">
			 <ul class="nav nav-tabs">
			 	 <li><a href="/access/index"                  class="btn btn-primary active">Home</a></li>
			 	 <li><a href="/dashboard/index"               class="btn btn-primary ">Profile</a></li>
			 	 <li><a href="/dashboard/display_all_books"   class="btn  btn-primary">All Books</a></li>
			 	 <li><a href="/dashboard/display_all_reviews" class="btn  btn-primary">All Reviews</a></li>
			 	 <li><a href="/dashboard/add_new_book"        class="btn  btn-primary">Add a new book and review</a></li>
			 	 <?php 
			 	 if($current_user)
			 	 	{?>
			 	 	  <li><a href="/dashboard/logout"              class="btn btn-danger">Logout</a></li>
			 	 <?php }
			 	 ?>
			 </ul>
	     </div>
	</div>

	<div>
		<?php if($this->session->flashdata('success_message'))
			 {
		?>
	          <div class="alert alert-success">
		     <?php echo $this->session->flashdata('success_message');?>
	         </div>	
	    <?php }  ?>
	</div>
	<div>
		<?php if($this->session->flashdata('error_message'))
		{?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('error_message');?>
		</div>	
	    <?php }  ?>
	</div>
	  