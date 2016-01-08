
<?php require 'header.php' ?>
<?php 
	$nearby_restaurants_limit = 3;
	$raterid = $_GET['userid'];
	$nearby = get_all_restaurants_with_limit($nearby_restaurants_limit);
?>
<div class="row">
	<div class="large-9 columns" role="content">
	<h1><?php echo $raterInfo['name'] ?></h1>
	Joined on <?php echo $raterInfo['join_date'] ?>
	  <div class="row">
	    <div class="large-3 columns">
	    	<?php echo "<img src='".pg_fetch_all(get_avatar_by_userid($raterid))[0]["avatar_url"]."'> "; ?><br />
	       	<a href="mailto:<?php echo $raterInfo['email'] ?>?Subject=Hello%20again%20<?php echo $raterInfo['name'] ?>" target="_top" class="button expand secondary tiny">Email this user</a> <br />
	    </div>
	    <div class="large-9 columns">
	    	<h3><small>Recent Activity</small></h3>
	    	<hr />
	    	<?php foreach ($raterReviews as $review): ?>
	    		<i class="foundicon-star"></i> <a href="raterProfile.php?userid=<?php echo $raterInfo['userid'] ?>"><?php echo $raterInfo['name'] ?></a> reviewed <a href="restaurant.php?rID=<?php echo $review['restaurantid'] ?>"><?php echo restaurant_name_based_on_id($review['restaurantid']) ?></a> on <?php echo $review['date_submitted'] ?><br />
    		<?php endforeach ?>
    		<hr />
	    	Don't see what you're looking for?<br />
	    	<a href="suggestions.php" class="button success tiny">Add Restaurant</a>
	    </div>
	  </div>
	  <hr/>

	  <h3><small>Reviews by <?php echo $raterInfo['name'] ?> (<?php echo $raterReviewCount['count'] ?>)</small></h3>
	  <?php if ($_SESSION['userid'] == $userid): ?>
		  <div class="row">
		      <a href="write-a-review.php?userid=<?php echo $raterInfo['userid'] ?>" class="button expand success">Write a Review</a>
		  </div>
	  <?php endif; ?>
	  <!-- Begin reviews done by the user -->
		<?php foreach ($raterReviews as $review): ?>
		  <article>
		    <div class="row">
		      <div class="large-3 columns">
		        <?php echo "<img src='".pg_fetch_all(get_avatar_by_userid($raterid))[0]["avatar_url"]."'> "; ?>
		      </div>
		      <div class="large-9 columns">
		        <h3><a href="restaurant.php?rID=<?php echo $review['restaurantid'] ?>"><?php echo restaurant_name_based_on_id($review['restaurantid']) ?></a></h3>
		        <h6><a href="raterProfile.php?userid=<?php echo $raterInfo['userid'] ?>"><?php echo $raterInfo['name'] ?></a> • <i class="foundicon-edit"></i> <a href=""><?php echo $raterReviewCount['count'] ?> Reviews</a></h6>
		            <p><?php echo $review['comments'] ?></p>
		            <p>Posted on <?php echo $review['date_submitted'] ?> <br /></p> 
		      </div>
		    </div>
		  </article>
	  	<hr/>
	  <?php endforeach ?>
	  <!-- End reviews done by the user -->
	</div>

<aside class="large-3 columns">
  <h3><small>Nearby</small></h3>
<?php   while ($near = pg_fetch_row($nearby)) {
  echo " <div class='row'>
    <div class='large-3 columns'>
        <img src='$near[4]' />
    </div>
        <div class='large-9 columns'>
        <h3><small><a href='restaurant.php?rID=$near[0]'>$near[1]</a></small></h3>
       <p><a href='http://$near[3]'><h5><small>$near[3]</small></h5></a></p>
      </div>
  </div>";
  } ?>
</aside>
 
</div>
 
 
  <!-- Footer -->
  <?php require 'footer.php' ?>