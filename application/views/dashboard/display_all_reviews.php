<h1 class="page-header">All Reviews</h1>

<?php foreach ($all_reviews as $reviews) {?>

 <div class="row">
 	<div class="col-md-8">
 		<h3>
 			<?php foreach ($all_books as $book)
	 		 {
	 			if($book['id']== $reviews['book_id'])
	 			{?>
	 				<a href="/dashboard/show_book/<?=$book['id']?>">
	 					<?php echo $book['title']; ?>
	 				</a>	
	 			<? }
	 		}
	 		 ?>
 		</h3>
 		<h4>
 			Rating :
 			<?php for ($i=0; $i < $reviews['rating']; $i++) { ?>
 			 <span class=" glyphicon glyphicon-star" aria-hidden="true"></span>
 				<?	}?>
 		</h4>
 		<p>
	 		<u>
				<a href="/dashboard/show_user/<?=$reviews['user_id'] ?>"> 
					<?php 
					foreach ($all_users as $user) {
						if( $user['id'] == $reviews['user_id'] )
						{
							echo $user['first_name'] ." ".$user['last_name'] ; 
						}
					} ?> 
				</a>	
			</u>says
 			<?php echo $reviews['content'] ; ?>
 		</p>
 		<p>
 			<h6>Posted on :  
 				<?php 
	 				$created_at = new DateTime($reviews['created_at']);
	 				$time_zone =  new DateTimeZone('America/Los_Angeles');
	 				$created_at->setTimezone($time_zone);
	 				echo date_format($created_at,'M d 20y , g:i A T') ;

 				 ; ?>
 			</h6>
 		</p>
 		
 	</div>
 </div>
 
<?php }
?>