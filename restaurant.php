<?php require_once 'model.php'; ?>
<?php $conn = open_database_connection() ?>
 
<?php require 'templates/header.php'; 
$ratings_limit = 5;
$nearby_restaurants_limit = 3;
$rid = $_GET['rID'];
$row = pg_fetch_row(restaurant_based_on_rid($rid));
$loc = pg_fetch_row(locations_based_on_rid($rid));
$m = get_menu_based_on_rid($rid);
$rating = get_all_ratings_by_rid_with_limit($rid, $ratings_limit);
$nearby = get_all_restaurants_with_limit($nearby_restaurants_limit);
$date = date("N", $timestamp) + 1;
$hours = get_todays_hours($date, $rid);
?>
<div class="row">

 
<div class="large-9 columns" role="content">
  <div class="row">
    <div class="large-3 columns">
      <?php echo "<img src='$row[4]' />"; ?>
        Downtown <br />
        <?php echo "$loc[4]"; ?> <br />
        <?php echo "<a href='http://$row[3]'>Website</a> <br />"; ?>
    </div>
    <div class="large-6 columns">
      <?php echo "<h2>$row[1]</h2>" ?><br />
      Restraunt Type: <?php echo "$row[2]" ?><br />
      Opened: <?php echo "$loc[1]"; ?> <br />
      Manager: <?php echo "$loc[2]"; ?> <br />
      <?php echo "$loc[3]"; ?> <br />
      Today's Hours: <?php echo "$hours[$date]"; ?> <br />
      <ul class="button-group even-3">
        <?php if (isset($_SESSION['created'])): ?>
          <li><a href="write-a-review.php?userid=<?php echo $_SESSION['userid'] ?>&restaurantid=<?php echo $row[0] ?>" class="tiny button secondary">Write a review</a></li>
        <?php else: ?>
          <li><a href="signin.php" class="tiny button secondary">Write a review</a></li>
        <?php endif; ?>
        <li><a href="#" class="tiny button secondary">Wishlist</a></li>
        <li><a href="#" class="tiny button secondary">Favourite</a></li>
      </ul>
    </div>
    <div class="large-3 columns text-center">
      <h1>85%</h1><br />like it.<br />
      <ul class="stack button-group">
        <li><a href = "#" class="tiny button expand">I Like it</a></li>
        <li><a href = "#" class="tiny button expand">I don't like it</a></li>
      </ul>
      123 votes <br />
      <a href="#">23 reviews</a>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="large-6 columns">
      <h2><small>Highest Rated</small></h5>
        <?php while ($menu = pg_fetch_row($m)) { ?>
        <?php echo "$menu[1] - $menu[5] <br />"; }?> <br />
      <a href="add-a-menu-item.php?restaurantid=<?php echo $rid ?>" class="button tiny secondary">Add a Menu Item</a>
    </div>
    <div class="large-6 columns">
      <?php 
      echo "<h3><small>Hours</small></h3>
      <h4><small>Mon: &nbsp; $hours[1]</small></h4>
      <h4><small>Tue: &nbsp; $hours[2]</small></h4>
      <h4><small>Wed: &nbsp; $hours[3]</small></h4>
      <h4><small>Thu: &nbsp; $hours[4]</small></h4>
      <h4><small>Fri: &nbsp; $hours[5]</small></h4>
      <h4><small>Sat: &nbsp; $hours[6]</small></h4>
      <h4><small>Sun: &nbsp; $hours[7]</small></h4>
      "; ?>
    </div>
  </div>
  <hr/>
  <h3>Reviews of <?php echo $row[1] ?></h3>
  <?php
  while ($rat = pg_fetch_row($rating)) {
  $reviewCount = pg_fetch_all(get_review_count_by_userid($rat[0]));
  $name = pg_fetch_all(get_username_by_userid($rat[0]));
  $avatar = pg_fetch_all(get_avatar_by_userid($rat[0]));
  echo "
  <article>
    <div class='row'>
      <div class='large-3 columns'>
        <img src='".$avatar[0]["avatar_url"]."' />
      </div>
      <div class='large-9 columns'>
            <h4><small>REVIEWED BY <a href='raterProfile.php?userid=$rat[0]'>".$name[0]["name"]."</a> • <i class='foundicon-idea'></i> <a href='raterProfile.php?userid=$rat[0]'>".$reviewCount[0]["count"]." Reviews</a></small></h4>
               <p>$rat[7]</p> <br /> 
               <p>Posted on $rat[1] <br /> Was this helpful?
               <ul class='button-group'>
              <li><a href='#' class='button tiny secondary'>Yes</a></li>
              <li><a href='#' class='button tiny secondary'>No</a></li>
            </ul></p> 
      </div>
    </div>
  </article>
  <hr/>
  "; } ?>
</div>

<aside class="large-3 columns">
  <h3 style="text-align: center"><small>Nearby</small></h3>
<hr/>
<?php   while ($near = pg_fetch_row($nearby)) {
  echo " <div class='row'>

          <div class='large-6 columns'>
          <h3><small><a href='restaurant.php?rID=$near[0]'>$near[1]</a></small></h3>
          <p><a href='http://$near[3]'><h5><small>$near[3]</small></h5></a></p>
          </div>
          <div class='large-6 columns'>
            <img src='$near[4]' />
          </div>
        </div>
        <hr/>";
  } ?>
</aside>
 
</div>
 
 
  <!-- Footer -->
  <?php require 'templates/footer.php' ?>