<?php 
	require_once 'model.php';
  	require_once 'templates/header.php';
  	$query_e_results = special_queries_e();
?>

<div class="row">
  <div class="large-12 columns">
  	For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main 
or desert), list the average prices of menu items for each category.
	<h1><small>Average Prices of menu items for each restaurant type</small></h1>
	<table class="large-12 columns">
		<tr>
			<td>Restaurant Type</td>
			<td>Menu Category</td>
			<td>Average Price</td>
		</tr>
		<?php foreach ($query_e_results as $result): ?>
		<tr>
			<td><?php echo $result['type'] ?>
			</td>
			<td><?php echo $result['category'] ?>
			</td>
			<td><?php echo $result['round'] ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
  </div> 
</div> 
<!-- FOOTER GOES BELOW -->
<?php require_once 'templates/footer.php' ?>