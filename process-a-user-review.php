<?php

	require_once 'model.php';

	$rating = array();

	$rating[UserID] 				= intval($_POST['userid']);
	$rating[Date_Submitted]       	= date('Y-m-d');
	$rating[Price]					= intval($_POST['price']);
	$rating[Food]					= intval($_POST['food']);
	$rating[Mood]					= intval($_POST['mood']);
	$rating[Staff]					= intval($_POST['staff']);
	$rating[Overall]				= intval($_POST['overall']);
	$rating[Comments]				= trim($_POST['comments']);
	$rating[Helpful]				= intval($_POST['helpful']);
	$rating[RestaurantID]			= intval($_POST['restaurantid']);

	$addRating = insert_new_rating($rating);

	if (!$addRating) {
          echo "An error occurred.\n";
          exit;
    } else {
        header("Location: restaurant.php?rID=" . $rating[RestaurantID]);
        die();
    }
?>