<h1 class="page-header">Add New Book and Review</h1>
<div class="col-md-5">
	<form action="/dashboard/create_book_and_review" method="post">
		 <div class="form-group">
		 	<h3>Book title</h3>
		 	<input type="text" name="book_title" class="form-control">
		 </div>
		 <div class="form-group">
		 	<h3>Author</h3>
		 	<label>Choose from the list</label>
		 	<select name="book_author" class="form-control">
 				<option value="select">Select</option>
				<?php foreach ($authors as $author) 
				{?>
				<option value="<?=$author['id']?>">
					<?php echo $author['first_name'] ." ".$author['last_name'];?>
				</option>
					
				<?php }?>
		 		</option>
		 	</select>
		 	<label>Add a new author</label>
		 	<input type="text" name="new_author" class="form-control"
		 	                  placeholder ="Please provide First Name Last Name"> 
		 </div>
		 <div class="form-group">
		 	<h3>Review</h3>
		 	<textarea name="review" class="form-control"></textarea>
		 </div>
		  <div class="form-group">
		 	<h3>Rating</h3>
		 	<select name="rating">
		 		<option value="1">1</option>
		 		<option value="2">2</option>
		 		<option value="3">3</option>
		 		<option value="4">4</option>
		 		<option value="5">5</option>
		 	</select> ** Stars
		 </div>
		 <input type="submit" name="form_action" value="Add new book" class="btn btn-primary"> 
	</form>
</div>




