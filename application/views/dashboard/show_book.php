
<h1 class="page-header"> Reviews by Book</h1>
<div class="row">
	<div class="col-md-5">
		<table class="table table-bordered">
			<tr><th>Title : 
				<?php echo $book_details['title'];?></th></tr>
			<tr><td>Author :
				<?php
				   foreach ($all_authors as $author) {
					   if($author['id'] == $book_details['author_id'] )
					   {
					   		echo $author['first_name'] . " " .$author['last_name'];
					   }
				   }
				  ?>
			</td></tr>
		</table>
	</div>
</div>

<div class="row">
  <div class="col-md-5 col-md-offset-1">
		<h4>
			<u>All Reviews for  <?php echo $book_details['title'];?>
			</u>
		</h4>
		<?php foreach ($all_reviews_by_book as $review) 
		{?>
		<div>
			<h4><?php 
					for ($i=0; $i < $review['rating']; $i++) { ?>
						<span class=" glyphicon glyphicon-star" aria-hidden="true"></span>
					<?}
				     ?>
			</h4>
			<p>
				<u>
					<?php foreach ($all_users as $user) 
						{
							if($user['id']== $review['user_id'])
							{
								
								echo  $user['first_name']." ".$user['last_name'] ;
							}
						}

					?>
				</u>
				 says : <?php echo  $review['content']; ?>
			</p>
			 <p>Posted on : <?php 

					 	    $created_at = new DateTime($review['created_at']);
			 				$time_zone =  new DateTimeZone('America/Los_Angeles');
			 				$created_at->setTimezone($time_zone);
			 				echo date_format($created_at,'M d 20y , g:i A T') ;?></p>
		</div>
		  <?php };?>
    </div>
    <div class="col-md-5 col-md-offset-1">
    	<h4>Add a new Review </h4>
    	<form action="/dashboard/create_review/<?=$book_details['id']?>/<?=$book_details['author_id']?>" 
    				method="post"class="well">
    		<div class="form-group">
    			<label>Review</label>
    			<textarea class="form-control" name="review"></textarea>
    		</div>
    		<div class="form-group">
    			<label>Rating : </label>
    			 <select name="rating">
    				 	<option value="1">1</option>
    				 	<option value="2">2</option>
    				 	<option value="3">3</option>
    				 	<option value="4">4</option>
    				 	<option value="5">5</option>
    			 </select>
    		</div>
 			<input type="submit" value="Submit Review" class="btn btn-primary">

    	</form>
    </div>
</div>
 
