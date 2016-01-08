<?php 
	require_once 'model.php';
  	require_once 'templates/header.php';
  	$query_f_results = special_queries_f();
?>

<div class="row">
  <div class="large-12 columns">
  	Find the total number of rating for each restaurant, for each rater. That is, the data should be 
grouped by the restaurant, the specific raters and the numeric ratings they have received.
	<h1><small>Total number of rating for each restaurant</small></h1>
	<table class="large-12 columns">
		<tr>
			<td>Rater</td>
			<td>Restaurant</td>
			<td>Number of Ratings</td>
		</tr>
		<?php foreach ($query_f_results as $result): ?>
		<tr>
			<td><?php echo get_rater_info($result['userid'])['name'] ?>
			</td>
			<td><?php echo $result['name'] ?>
			</td>
			<td><?php echo $result['count'] ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
  </div> 
</div> 
<!-- FOOTER GOES BELOW -->
<?php require_once 'templates/footer.php' ?>