<?php 
	require_once 'model.php';
  	require_once 'templates/header.php';
  	$query_l_results = special_queries_l();
?>

<div class="row">
  <div class="large-12 columns">
  	Find the names and reputations of the raters that give the highest overall rating, in terms of the 
Food  or  the  Mood  of  restaurants.  Display  this  information  together  with  the  names  of  the 
restaurant and the dates the ratings were done.
	<h1><small>Raters  that  give  the  highest  overall  rating (Food or Mood)</small></h1>
	<table class="large-12 columns">
		<tr>
			<td>Rater</td>
			<td>Reputation</td>
			<td>Date of Rating</td>
			<td>Restaurant</td>
		</tr>
		<?php foreach ($query_l_results as $result): ?>
		<tr>
			<td><?php echo $result['name'] ?>
			</td>
			<td><?php echo $result['reputation'] ?>
			</td>
			<td><?php echo $result['date_submitted'] ?>
			</td>
			<td><?php echo $result['resname'] ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
  </div> 
</div> 
<!-- FOOTER GOES BELOW -->
<?php require_once 'templates/footer.php' ?>