<?php require 'header.php' ?>
 
<div class="row">
 
<div class="large-12 columns" role="content">
<h1><small>All Restaurants in Ottawa</small></h1>
    <!-- Rater Loop Start -->
    <?php foreach ($restaurants as $restaurant): ?>
      <div class="row">
        <div class="large-3 columns">
            <img src="<?php echo $restaurant['logo_url']?>" />
             <br />
            <a href="http://<?php echo $restaurant['url']?>" target="_top">Website</a> <br />
        </div>
        <div class="large-9 columns">
          <h1><a href="restaurant.php?rID=<?php echo $restaurant['restaurantid'] ?>"><?php echo $restaurant['name'] ?></a></h1>
          <?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['street_address'] ?> <br />
          <b>Manager</b>: <?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['manager'] ?> <br />
          <b>Opened</b>: <?php echo $restaurant_location_info[$restaurant['restaurantid']][0]['first_open_date'] ?> <br />
        </div>
      </div>
      <hr />
    <?php endforeach ?>
    <!-- Rater Loop End -->
</div>
 
</div>
<!-- Footer -->
<?php require 'footer.php' ?>