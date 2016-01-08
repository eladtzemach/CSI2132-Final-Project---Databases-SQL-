<?php
	require_once 'model.php';

	$restaurantid 			= get_new_restaurantid();
	$restaurantTypeEnums 	= get_all_restaurant_type_enums();

	$locationid 			= get_new_locationid();

	require 'templates/suggestions.php';
?>