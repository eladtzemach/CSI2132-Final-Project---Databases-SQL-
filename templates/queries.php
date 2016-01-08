<?php 
  require_once 'header.php';
  // $restaurant_type = get_all_restaurant_types();
?>

<!-- Begin Create an account form -->
<div class="row">
  <div class="large-12 columns">
  	<table class="large-12 columns">
  		<tr>
  			<td>Query</td>
  			<td>Description</td>
  		</tr>
  		<tr>
  			<td><a href="query_e.php">E</a></td>
  			<td>For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main 
or desert), list the average prices of menu items for each category.
			</td>
  		</tr>
  		<tr>
  			<td><a href="query_f.php">F</a></td>
  			<td>Find the total number of rating for each restaurant, for each rater. That is, the data should be 
grouped by the restaurant, the specific raters and the numeric ratings they have received.
			</td>
  		</tr>
		<tr>
  			<td><a href="query_g.php">G</a></td>
  			<td>Display  the  details  of  the  restaurants  that  have  not  been  rated  in  January  2015.  That  is,  you 
should  display  the  name  of  the  restaurant  together  with  the  phone  number  and  the  type  of 
food.
			</td>
  		</tr>
  		<tr>
  			<td><a href="query_j.php">J</a></td>
  			<td>Provide  a  query  to  determine  whether  Type  Y  restaurants  are  “more  popular”  than  other 
restaurants.  (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.)
			</td>
  		</tr>
  		<tr>
  			<td><a href="query_k.php">K</a></td>
  			<td>Find  the  names,  join‐date  and  reputations  of  the  raters  that  give  the  highest  overall  rating,  in 
terms  of  the  Food  and  the  Mood  of  restaurants.  Display  this  information  together  with  the 
names of the restaurant and the dates the ratings were done. 
			</td>
  		</tr>
  		<tr>
  			<td><a href="query_l.php">L</a></td>
  			<td>Find the names and reputations of the raters that give the highest overall rating, in terms of the 
Food  or  the  Mood  of  restaurants.  Display  this  information  together  with  the  names  of  the 
restaurant and the dates the ratings were done. 
			</td>
  		</tr>
  	</table>
  </div> 
</div> 
<!-- End Create an account form -->
<?php require_once 'footer.php' ?>