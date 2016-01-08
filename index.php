<?php require_once 'model.php'; ?>
<?php $conn = open_database_connection(); ?>
 
<?php require 'templates/header.php'; 
    $limit = 5;

    $restaurantTypeEnums  = get_all_restaurant_type_enums();


    if (isset($_GET['filter'])) { 
      $result = get_all_sorted_restaurants_with_limit($limit, $_GET['filter']); 
      $reviews = get_all_ratings($limit, $_GET['filter']);
    } else {
      $result = get_all_restaurants_with_limit($limit); 
      $reviews = get_all_ratings($limit);
    }


?>
 
 
<div class="row">

<aside class="large-3 columns">
  <h3><small>Cuisines</small></h3>
  <ul class="stack button-group">
    <?php foreach ($restaurantTypeEnums as $restaurantTypeEnum): ?>
      <?php $restaurantTypeEnum = $restaurantTypeEnum['unnest'] ?>
      <li><a href="filterRestaurants.php?filter=<?php echo $restaurantTypeEnum ?>"><?php echo $restaurantTypeEnum ?> (<?php echo get_restaraunt_enum_type_count($restaurantTypeEnum) ?>)</a></li>
    <?php endforeach; ?>
  </ul>
</aside>

<!-- Begin restaurant section -->
 <div class='large-9 columns'>
 <?php  while ($row = pg_fetch_row($result)) { ?>
 <div class="row">
  <!-- Begin restaurant description -->
    <div class='large-5 columns' role='content'>
            <?php echo "<h3><a href='restaurant.php?rID=$row[0]'>$row[1]</a></h3> "; ?> 
            <?php echo "<h5>Ottawa, Ontario, Canada </h5>"; ?>
            <?php echo "Restaurant Style: $row[2] "; ?> <br />
            <?php echo "Restaurant Website: <a href='http://$row[3]'>$row[3]</a> "; ?> <br />
            <?php $locationResults = locations_based_on_rid($row[0]); ?>
            <?php echo "Locations: " ?> <br>
                  <?php while ($row2 = pg_fetch_row($locationResults)) { ?>
                    <?php echo "Street Address: $row2[4]"; ?> <br>
                    <?php echo "Phone Number: $row2[3]"; ?>
                  <?php } ?>
    </div>
    <!-- End restaurant description -->
    <!-- Begin restaurant Picture and Review Score -->
      <div class="large-4 columns">
        <?php echo "<img src='$row[4]'/>"; ?>
          <br />
          <br />
            <div class="ratings-container">
            <?php 
            $avg = get_average_scores_by_rid($row[0]);
            echo "<table>
              <tr>
                <td>$</td>
                <td>Food</td>
                <td>Mood</td>
                <td>Staff</td>
                <td>Avg</td>
              </tr>";
        
            while ($row3 = pg_fetch_row($avg)) {
                echo "<tr><td>$row3[0]</td><td>$row3[1]</td><td>$row3[2]</td><td>$row3[3]</td><td>$row3[4]</td></tr>";
                echo "\n";
            }

            echo "</table>"; 
            ?>
          </div>
        </div>
      <!-- End restaurant Picture and Review Score -->
      </div>
           <hr/>
      <?php } ?>
</div>
<!-- End restaurant section -->
<!-- Begin Random Reviews -->
<div class='large-9 columns' role='content'>
  <?php 
  while($rev = pg_fetch_row($reviews)) {
  echo "
    <article>
      <div class='row'>
        <div class='large-3 columns'>
          <img src='".pg_fetch_all(get_avatar_by_userid($rev[0]))[0]["avatar_url"]."' />
        </div>
        <div class='large-9 columns'>
          <h3><a href='restaurant.php?rID=$rev[0]''>".restaurant_name_based_on_id($rev[9])."</a></h3>
          <h6>REVIEWED BY <a href='raterProfile.php?userid=$rev[0]'>".pg_fetch_all(get_username_by_userid($rev[0]))[0]["name"]."</a> • <i class='foundicon-star'></i> <a href='raterProfile.php?userid=$rev[0]'>".pg_fetch_all(get_review_count_by_userid($rev[0]))[0]["count"]." reviews</a></h6>
              <p>".substr($rev[7], 0, 140)."...</p>
              <a href='restaurant.php?rID=$rev[0]''>Full Review</a> <br />
              <p>Posted on ".$rev[1]."</p> 
        </div>
      </div>
    </article>
  ";
  }?>
</div>
 
  <!-- Footer -->
  <?php require 'templates/footer.php' ?>

