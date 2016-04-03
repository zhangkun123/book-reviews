<h1 class="page-header">All Books In the Inventory</h1>
<div class="col-md-8">
	<table class="table table-striped table-bordered">
	<thead>
		<th>Book title</th>
		<th>Author</th>
	</thead>
	<?php foreach ($all_books as $book) 
		{?>
		 <tr>
		 	<td>
				<a href="/dashboard/show_book/<?=$book['id']?>/">
				<?php echo $book['title'];?></a>
	 		</td>
			 <td>
		 		<?php foreach ($all_authors as $author) 
		 		{
			 		if($author['id']==$book['author_id'])
			 		{
			 				echo $author['first_name']." ".$author['last_name'];
			 		}
		 		}
				 ?>
			</td>
		 </tr>	
	<?	}
	?>
</table>
</div>
