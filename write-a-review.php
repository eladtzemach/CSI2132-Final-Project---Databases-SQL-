<?php
	require_once 'model.php';
	
	session_start();

	if (isset($_GET['userid'])){
	 if ($_SESSION['userid'] == $_GET['userid']) {
	 	if(isset($_GET['restaurantid'])){
			$userid 							= $_GET['userid'];
			$restaurants 						= array();
			$restaurants[0]['name'] 			= restaurant_name_based_on_id($_GET['restaurantid']);	 
			$restaurants[0]['restaurantid'] 	= intval($_GET['restaurantid']);

		} else{
				$userid 		= $_GET['userid'];
				$restaurants 	= get_all_restaurants();
		}
		require 'templates/write-a-review.php';
	 } else {
		require 'logout.php';
	 }
	} else {
		header('Location: index.php');
		die();
	}
?>