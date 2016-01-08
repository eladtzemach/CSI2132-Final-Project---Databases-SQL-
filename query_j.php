<?php 
	require_once 'model.php';
  	require_once 'templates/header.php';
  	$query_j_results = special_queries_j();
?>

<div class="row">
  <div class="large-12 columns">
  	Provide  a  query  to  determine  whether  Type  Y  restaurants  are  “more  popular”  than  other 
restaurants.  (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.) 
	<h1><small>Popular Restaurants</small></h1>
	<table class="large-12 columns">
		<tr>
			<td>Restaurant Type</td>
			<td>Average Score</td>
		</tr>
		<?php foreach ($query_j_results as $result): ?>
		<tr>
			<td><?php echo $result['type'] ?>
			</td>
			<td><?php echo $result['average'] ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
  </div> 
</div> 
<!-- FOOTER GOES BELOW -->
<?php require_once 'templates/footer.php' ?>