<?php
	require_once 'model.php';

	if (empty($_POST['submitted']) && isset($_GET['restaurantid'])){
		// Regular page response 
       	$restaurantId 			= $_GET['restaurantid'];
		$restaurantName 		= restaurant_name_based_on_id($restaurantId);
		$restaurantMenuItems 	= get_restaurant_menu($restaurantId);

		$itemId 			= get_new_itemid();
		$itemEnums 			= get_all_item_enums();
		$itemCategoryEnums 	= get_all_itemCategory_enums();

		require 'templates/add-a-menu-item.php';
		
    } elseif (isset($_POST['submitted'])) {
    	// page response after a post

	    // NOTE!!!
	    // Assumption: Everything is entered correctly
	    // Creating a new menu item

    	$newMenuItem = array();

    	$newMenuItem[ItemID] 		= intval($_POST['itemid']);
    	$newMenuItem[Name] 			= trim($_POST['name']);
    	$newMenuItem[Type] 			= $_POST['item-type'];
    	$newMenuItem[Category] 		= $_POST['item-category'];
    	$newMenuItem[Description] 	= trim($_POST['description']);
    	$newMenuItem[Price] 		= $_POST['price'];
    	$newMenuItem[RestaurantID] 	= intval($_POST['restaurantid']);

    	$addNewMenuItem = insert_new_menuItem($newMenuItem);

    	if ($addNewMenuItem){
    		header('Location: restaurant.php?rID=' . $newMenuItem[RestaurantID]);
			die();
    	} else {
    		echo "An error occurred.\n";
          	die();
    	}

    } else {
    	// page response if someone accidentally enters the page
    	header('Location: index.php');
		die();
    }
?>