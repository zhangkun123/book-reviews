<?php $book_details = array();
$index = 0; ?>
<h1 class="page-header">
	<?php echo $user_details['first_name']
 							." ".$user_details['last_name'];?>
 </h1>
 <h4>
 	<u>Posted Reviews for</u>
 </h4>
<div class="col-md-8">
	 <table class="table table-striped">
	 	<thead>
	 		<th>Titles</th>
	 	</thead>
	 	<?php 
	  	foreach ($books_reviewed_by_user as $book) 
	  		{?>
	  		 <tr>
	  		 	<td> <a href="/dashboard/show_book/<?=$book['id']?>">
	  		 		<?php echo $book['title']; ?>  
	  		 	</a>
	  		 	</td>
	  		 </tr>
	  		<?php }?>		 
 	</table>
</div>
 
 

	 
 


 