<?php 
  require_once 'header.php';
  session_destroy(); 
  $restaurant_type = get_all_restaurant_types();
?>

<?php require_once 'rest_types.php'; ?>
<!-- Begin Create an account form -->
<div class="row">
  	<div class="large-12 columns">
      <h3>Ottawa <restaurant-type> Places</h3>
	</div>
	<div class="large-4 columns">
		<table>
		  <?php
		  if (empty($restaurant_location_info)): ?>
		  		<tr>
		  			<td>
		  				Don't see what you're looking for?<br />
	    				<a href="suggestions.php" class="button success tiny">Add Restaurant</a>
		  			</td>
		  		</tr>
		  	<?php else: ?>
				<?php foreach ($restaurants as $restaurant): ?>
					<tr>
						<td>
				      	<a href="restaurant.php?rID=<?php echo $restaurant['restaurantid'] ?>"><?php echo $restaurant['name'] ?></a><br />
				      	Ottawa <br />
			       		<?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['street_address'] ?> <br />
			       		<b>Manager</b>: <?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['manager'] ?> <br />
			       		<b>Opened</b>: <?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['first_open_date'] ?> <br />
			       		</td>
					</tr>
			  	<?php endforeach; ?>
	  		<?php endif; ?>
	  	</table>
	</div>
	<div class="large-8 columns">
		<!-- OLD View -->
		<!-- <iframe
		  width="600"
		  height="450"
		  frameborder="0" style="border:0"
		  src="https://www.google.com/maps/embed/v1/place?key=$google_maps_api_key
		    &q=Byward+Market,Ottawa,On">
		</iframe> -->
		<?php
		  if (empty($restaurant_location_info)): ?>
		  		<img src="https://maps.googleapis.com/maps/api/staticmap?center=Ottawa,On
				&zoom=13
				&size=600x450
				&format=png
				" />
				<!-- &key=$google_maps_api_key -->
	  	<?php else: ?>
			<img src="https://maps.googleapis.com/maps/api/staticmap
			?center=Ottawa,On
			&zoom=13
			&size=600x450
			<?php foreach ($restaurants as $restaurant): ?>
			&markers=size:mid%7Ccolor:red%7Clabel:R%7C<?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['street_address'] ?>,Ottawa,On
			<?php endforeach; ?>
			&format=png" />
			<!-- &key=$google_maps_api_key -->
		<?php endif; ?>
	</div>
  </div> 
</div> 

<!-- End Create an account form -->
<?php require_once 'footer.php' ?>