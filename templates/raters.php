<?php require 'header.php' ?>
 
<div class="row">
 
<div class="large-12 columns" role="content">
  <h1><small>All of our raters</small></h1>
    <!-- Rater Loop Start -->
    <?php foreach ($raters as $rater): ?>
      <div class="row">
        <div class="large-3 columns">
            <img src="<?php echo $rater_avatar[$rater['userid']][0]['avatar_url'] ?>" />
             <br />
            <a href="mailto:<?php echo $rater['email'] ?>?Subject=Hello%20again%20<?php echo $rater['name'] ?>" target="_top">Send Mail</a> <br />
        </div>
        <div class="large-9 columns">
          <h1><a href="raterProfile.php?userid=<?php echo $rater['userid'] ?>"><?php echo $rater['name'] ?></a></h1> <br />
          Joined on <?php echo $rater['join_date'] ?> <br />
          Reviewed the following restaurants:
            <?php
                $reviews = null; 
                $reviews = get_all_restaurants_reviewed($rater['userid']); 
                ?>
            <ul>
                <!-- Reviewed Restaurants Start -->
            <?php foreach ($reviews as $review): ?>
                <li> 
                    <?php $restaurantid = $review['restaurantid'] ?>
                    <a href="restaurant.php?rID=<?php echo $review['restaurantid'] ?>"><?php echo restaurant_name_based_on_id($restaurantid) ?></a>
                </li>
            <?php endforeach ?>
                <!-- Reviewed Restaurants End -->
            </ul>
        </div>
      </div>
      <hr />
    <?php endforeach ?>
    <!-- Rater Loop End -->
</div>
 
</div>
<!-- Footer -->
<?php require 'footer.php' ?>
