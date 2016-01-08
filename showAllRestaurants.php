<?php
	require_once 'model.php';

	$restaurants = get_all_restaurants();

	$restaurant_location_info = array();

	foreach ($restaurants as $restaurant):
		$restaurntId = $restaurant['restaurantid'];
		$restaurant_location_info[$restaurntId] = location_info_based_on_restaurantId($restaurntId);
	endforeach;

	require 'templates/showAllRestaurants.php';
?>