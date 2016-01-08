<?php
	require_once 'model.php';
	require_once 'connectors/google_maps_api.php';

	$restaurants = get_all_restaurants_by_type($_GET['filter']);

	$restaurant_location_info = array();

	foreach ($restaurants as $restaurant):
		$restaurntId = $restaurant['restaurantid'];
		$restaurant_location_info[$restaurntId] = location_info_based_on_restaurantId($restaurntId);
	endforeach;

	require 'templates/filterRestaurants.php';
?>