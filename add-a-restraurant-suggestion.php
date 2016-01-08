<?php
    
    require_once 'model.php';

    //  Restaurant(RestaurantID, Name, Type, URL)

    //  Location(LocationID, First_Open_Date, Manager, Phone_Number, Street_Address, Hour_Open, Hour_Close, RestaurantID)

    $restaurantid           = $_POST['restaurantid'];
    $restaurantName         = trim($_POST['Name']);
    $restaurantType         = $_POST['Type'];
    $restaurantURL          = trim($_POST['URL']);

    // NOTE!!!
    // Assumption: Everything is entered correctly
    // Creating a new restaurant
    $restaurant = array();

    $restaurant[RestaurantID]       = $restaurantid;
    $restaurant[Name]               = $restaurantName;
    $restaurant[Type]               = $restaurantType;
    $restaurant[URL]                = $restaurantURL;

    $addRestaurant = insert_new_restaurant($restaurant);

    if ($addRestaurant) {
        // NOTE!!!
        // Assumption: Everything is entered correctly
        // Creating a new location
        $location = array();

        $location[LocationID]           =  $_POST['locationid'];
        $location[First_Open_Date]      =  trim($_POST['First_Open_Date']);
        $location[Manager]              =  trim($_POST['Manager']);
        $location[Phone_Number]         =  trim($_POST['Phone_Number']);
        $location[Street_Address]       =  trim($_POST['Street_Address']);
        $location[Hour_Open]            =  trim($_POST['Hour_Open']);
        $location[Hour_Close]           =  trim($_POST['Hour_Close']);
        $location[RestaurantID]         =  $restaurantid;

        $addLocation = insert_new_location($location);

        if($addLocation){
            header("Location: restaurant.php?rID=" . $restaurantid);
            die();
        }

    } else {
        echo "An error occurred.\n";
        exit;
    }

?>