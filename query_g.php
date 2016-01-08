<?php 
	require_once 'model.php';
  	require_once 'templates/header.php';
  	$query_g_results = special_queries_g();
?>

<div class="row">
  <div class="large-12 columns">
  	Display  the  details  of  the  restaurants  that  have  not  been  rated  in  January  2015.  That  is,  you 
should  display  the  name  of  the  restaurant  together  with  the  phone  number  and  the  type  of 
food.
	<h1><small>Restaurants  that  have  not  been  rated  in  January  2015</small></h1>
	<table class="large-12 columns">
		<tr>
			<td>Restaurant</td>
			<td>Phone number</td>
			<td>Type of Food</td>
		</tr>
		<?php foreach ($query_g_results as $result): ?>
		<tr>
			<td><?php echo $result['name'] ?>
			</td>
			<td><?php echo $result['phone_number'] ?>
			</td>
			<td><?php echo $result['type'] ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
  </div> 
</div> 
<!-- FOOTER GOES BELOW -->
<?php require_once 'templates/footer.php' ?>