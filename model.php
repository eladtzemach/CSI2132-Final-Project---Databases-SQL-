<?php

	function open_database_connection(){

		// Please note that the following user must have the necessary permissions to manipulate the tables in the csi2132a database

		$host 		= 'localhost';
		$port 		= '5432';
		$user 		= 'student';
		$password 	= 'winter2015';
		$dbname 	= 'csi2132a';

		$options = "host={$host} port={$port} user={$user} password={$password} dbname={$dbname}";
		$conn = pg_connect($options);

		if(!$conn){
			echo "Connection Failed \n";
			exit;
		}
		return $conn;
	}

	function close_database_connection($conn) {
		pg_close($conn);
	}

	function get_all_restaurants_with_limit($limit) {

		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT * FROM restaurant LIMIT $limit;");

		close_database_connection($conn);

		return $result;
	}

	function get_all_sorted_restaurants_with_limit($limit, $filter) {

		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT * FROM restaurant r WHERE r.Type = '$filter' LIMIT $limit;");

		close_database_connection($conn);

		return $result;
	}

	function get_all_restaurants_by_type($filter) {

		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT * FROM restaurant r WHERE r.Type = '$filter'");

		close_database_connection($conn);

		$restaurants = array();

		while ($row = pg_fetch_assoc($result)) {
			$restaurants[] = $row;
		}

		return $restaurants;
	}

	function get_all_restaurants() {
		
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT * FROM restaurant ORDER BY name asc");

		$rest = array();

		while ($row = pg_fetch_assoc($result)) {
			$rest[] = $row;
		}

		close_database_connection($conn);

		return $rest;
	}

	function get_all_raters(){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT * FROM rater");

		$raters = array();

		while($row = pg_fetch_assoc($result)){
			$raters[] = $row;
		}

		close_database_connection($conn);

		return $raters;
	}

	function get_rater_info($rater){
		$conn = open_database_connection();

		$userid = intval($rater);

		$result = pg_query($conn, "SELECT * FROM rater WHERE userid = " . $userid);

		$raterInfo = pg_fetch_array($result);

		close_database_connection($conn);

		return $raterInfo;
	}

	function check_rater_existence($name, $email){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT userid FROM rater WHERE name = '" . $name . "' and email = '" . $email . "'");

		$raterUserId = pg_fetch_array($result);

		close_database_connection($conn);

		return $raterUserId;
	}

	function get_restaraunt_enum_type_count($enumType){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT count(restaurantid) FROM restaurant R, (SELECT unnest(enum_range(NULL::restaurant_type))::text AS restaurant_type) AS E WHERE R.type::text = E.restaurant_type::text AND R.type = '$enumType'");

		$raterUserId = pg_fetch_array($result);

		close_database_connection($conn);

		return $raterUserId[0];
	}

	function get_rater_review_count($rater){
		$conn = open_database_connection();

		$userid = intval($rater);

		$result = pg_query($conn, "SELECT count(*) FROM rater R, rating RA WHERE R.userid = " . $userid . " and RA.userid=" . $userid);

		$raterCount = pg_fetch_array($result);

		close_database_connection($conn);

		return $raterCount;
	}

	function get_rater_reviews($rater){
		$conn = open_database_connection();

		$userid = intval($rater);

		$result = pg_query($conn, "SELECT * FROM rater R, rating RA WHERE R.userid = " . $userid . " and RA.userid=" . $userid . " ORDER BY date_submitted desc");

		$raterReviews = array();

		while($row = pg_fetch_assoc($result)){
			$raterReviews[] = $row;
		}

		close_database_connection($conn);

		return $raterReviews;
	}

	function get_all_ratings($limit, $filter = null) {
		$conn = open_database_connection();

		if (isset($filter)){
			$query = "SELECT * FROM rating r, restaurant x WHERE (r.RestaurantID = x.RestaurantID AND x.Type = '$filter') ORDER BY RANDOM() LIMIT $limit;";
		} else {
			$query = "SELECT * FROM rating r ORDER BY RANDOM() LIMIT $limit;";
		}

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_all_ratings_by_rid_with_limit($rid, $ratings_limit = 50) {
		$conn = open_database_connection();

		$query = "SELECT * FROM rating r WHERE r.RestaurantID = $rid LIMIT $ratings_limit;";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_todays_hours($date, $rid) {
		$conn = open_database_connection();

		$query = "SELECT * FROM Operation_Hours o WHERE o.RestaurantID = $rid;";

		$result = pg_fetch_row(pg_query($conn, $query));

		close_database_connection($conn);

		return $result;
	}

	function get_review_count_by_userid($userid) {
		$conn = open_database_connection();

		$query = "SELECT COUNT(r.UserID) FROM Rating r WHERE r.UserID = $userid;";
		
		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_username_by_userid($userid) {
		$conn = open_database_connection();

		$query = "SELECT Name FROM Rater r WHERE r.UserID = $userid;";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_avatar_by_userid($userid) {
		$conn = open_database_connection();

		$query = "SELECT Avatar_URL FROM Rater r WHERE r.UserID = $userid;";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_avatar_by_userid_not_psql($userid) {
		$conn = open_database_connection();

		$query = "SELECT Avatar_URL FROM Rater r WHERE r.UserID = $userid;";

		$result = pg_query($conn, $query);

		$avatar = array();

		while($row = pg_fetch_assoc($result)){
			$avatar[] = $row;
		}

		close_database_connection($conn);

		return $avatar;
	}

	function get_menu_based_on_rid($restaurantid) {
		$conn = open_database_connection();

		$query = "SELECT * FROM Menuitem m WHERE m.RestaurantID = $restaurantid  ";

		$result = pg_query($conn, "SELECT * FROM Menuitem m WHERE m.RestaurantID = $restaurantid");

		close_database_connection($conn);

		return $result;
	}

	function get_restaurant_menu($restaurantId){
		// Retreive the menu ordered by menu item type

		$conn = open_database_connection();

		$restaurantid = intval($restaurantId);

		$result = pg_query($conn, "SELECT m.name, m.price, m.type, m.category FROM Menuitem m WHERE m.RestaurantID = " . $restaurantid . " ORDER BY m.type ");

		$menuItemInfo = array();

		while($row = pg_fetch_assoc($result)){
			$menuItemInfo[] = $row;
		}

		close_database_connection($conn);

		return $menuItemInfo;
	}

	function get_new_userid(){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT count(userid) FROM rater");

		$userscurrent = pg_fetch_assoc($result);

		$userscurrent = intval($userscurrent[count]);

		$userid = $userscurrent + 1;

		close_database_connection($conn);

		return $userid;
	}

	function get_new_restaurantid(){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT count(restaurantid) FROM Restaurant");

		$restaurantidcurrent = pg_fetch_assoc($result);

		$restaurantidcurrent = intval($restaurantidcurrent[count]);

		$restaurantid = $restaurantidcurrent + 1;

		close_database_connection($conn);

		return $restaurantid;
	}

	function get_new_locationid(){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT count(locationid) FROM Location");

		$locationidcurrent = pg_fetch_assoc($result);

		$locationidcurrent = intval($locationidcurrent[count]);

		$locationid = $locationidcurrent + 1;

		close_database_connection($conn);

		return $locationid;
	}

	function get_new_itemid(){
		$conn = open_database_connection();

		$result = pg_query($conn, "SELECT count(ItemID) FROM MenuItem");

		$itemIdCurrent = pg_fetch_assoc($result);

		$itemIdCurrent = intval($itemIdCurrent[count]);

		$itemId = $itemIdCurrent + 1;

		close_database_connection($conn);

		return $itemId;
	}

	function get_all_restaurants_reviewed($raterid){
		$conn = open_database_connection();

		$userid = intval($raterid);
		$query = "SELECT restaurantid, overall FROM rating WHERE userid = " .$userid;
		$result = pg_query($conn, $query);

		$restaurants_reviewed = array();

		while($row = pg_fetch_assoc($result)){
			$restaurants_reviewed[] = $row;
		}

		close_database_connection($conn);

		return $restaurants_reviewed;
	}

	function restaurant_name_based_on_id($restaurantid){
		$conn = open_database_connection();

		$restaurantid = intval($restaurantid);
		$restaurantid = $restaurantid - 1;
		$query = "SELECT * FROM restaurant";

		$result = pg_query($conn, $query);

		$restaurants = array();

		while($row = pg_fetch_assoc($result)){
			$restaurants[] = $row;
		}

		close_database_connection($conn);

		return $restaurants[$restaurantid]['name'];

	}

	function restaurant_based_on_rid($rid) {
		$conn = open_database_connection();

		$query = "SELECT * FROM restaurant r WHERE r.RestaurantID = $rid;";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function get_average_scores_by_rid($rid) {

		$conn = open_database_connection();

		$query = "SELECT ROUND(AVG(r.Price), 1), ROUND(AVG(r.Food), 1), ROUND(AVG(r.Mood), 1), ROUND(AVG(r.Staff), 1), ROUND(AVG(r.Overall), 1) FROM rating r WHERE r.RestaurantID = $rid;"; 

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;

	}

	function locations_based_on_rid($restaurantid) {
		$conn = open_database_connection();

		$restaurantid = intval($restaurantid);

		$query = "SELECT * FROM location l WHERE l.RestaurantID = $restaurantid;";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function location_info_based_on_restaurantId($restaurantid) {
		$conn = open_database_connection();

		$restaurantid = intval($restaurantid);

		$query = "SELECT * FROM location l WHERE l.RestaurantID = $restaurantid;";

		$result = pg_query($conn, $query);

		$locations = array();

		while($row = pg_fetch_assoc($result)){
			$locations[] = $row;
		}

		close_database_connection($conn);

		return $locations;
	}

	function get_all_restaurant_type_enums(){
		$conn = open_database_connection();

		$query = "SELECT unnest(enum_range(NULL::restaurant_type))";
		$result = pg_query($conn, $query);

		$restaurantTypeEnums = array();

		while($row = pg_fetch_assoc($result)){
			$restaurantTypeEnums[] = $row;
		}

		close_database_connection($conn);

		return $restaurantTypeEnums;
	}

	function get_all_rater_enums(){
		$conn = open_database_connection();

		$query = "SELECT unnest(enum_range(NULL::rater_type))";
		$result = pg_query($conn, $query);

		$raterEnums = array();

		while($row = pg_fetch_assoc($result)){
			$raterEnums[] = $row;
		}

		close_database_connection($conn);

		return $raterEnums;
	}

	function get_all_restaurant_types(){
		$conn = open_database_connection();

		$query = "SELECT unnest(enum_range(NULL::restaurant_type))";
		$result = pg_query($conn, $query);

		$restaurantType = array();

		while($row = pg_fetch_assoc($result)){
			$restaurantType[] = $row;
		}

		close_database_connection($conn);

		return $restaurantType;
	}

	function get_all_item_enums(){
		$conn = open_database_connection();

		$query = "SELECT unnest(enum_range(NULL::item_type))";
		$result = pg_query($conn, $query);

		$itemEnums = array();

		while($row = pg_fetch_assoc($result)){
			$itemEnums[] = $row;
		}

		close_database_connection($conn);

		return $itemEnums;
	}

	function get_all_itemCategory_enums(){
		$conn = open_database_connection();

		$query = "SELECT unnest(enum_range(NULL::item_category))";
		$result = pg_query($conn, $query);

		$itemCategoryEnums = array();

		while($row = pg_fetch_assoc($result)){
			$itemCategoryEnums[] = $row;
		}

		close_database_connection($conn);

		return $itemCategoryEnums;
	}

	function insert_new_rater($rater){
		$conn = open_database_connection();

		$query = "INSERT INTO Rater(UserID, Email, Name, Join_Date, Type, Reputation) 
                    VALUES(" . $rater[UserID] .", '" . $rater[Email] ."', '" . $rater[Name] ."', '" . $rater[Join_Date] ."', '" . $rater[Type] ."', " . $rater[Reputation] .")";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function insert_new_restaurant($restaurant){
		$conn = open_database_connection();

		$query = "INSERT INTO Restaurant(RestaurantID, Name, Type, URL) 
                    VALUES(" . $restaurant[RestaurantID] .", '" . $restaurant[Name] ."', '" . $restaurant[Type] ."', '" . $restaurant[URL] ."')";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function insert_new_location($location){
		$conn = open_database_connection();

		$query = "INSERT INTO Location(LocationID, First_Open_Date, Manager, Phone_Number, Street_Address, Hour_Open, Hour_Close, RestaurantID) VALUES(" . $location[LocationID] .", '" . $location[First_Open_Date] ."', '" . $location[Manager] ."', '" . $location[Phone_Number] ."', '" . $location[Street_Address] . "', '" . $location[Hour_Open] . "', '" . $location[Hour_Close] . "', " . $location[RestaurantID] . ")";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function insert_new_rating($rating){
		$conn = open_database_connection();

		$query = "INSERT INTO Rating(UserID, Date_Submitted, Price, Food, Mood, Staff, Overall, Comments, Helpful, RestaurantID) VALUES(" . $rating[UserID] .", '" . $rating[Date_Submitted] ."', " . $rating[Price] .", " . $rating[Food] .", " . $rating[Mood] .", " . $rating[Staff] .", ". $rating[Overall] .", '" . $rating[Comments] . "', " . $rating[Helpful] . ", ". $rating[RestaurantID] .")";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function insert_new_menuItem($newMenuItem){
		$conn = open_database_connection();

		$query = "INSERT INTO MenuItem(ItemID, Name, Type, Category, Description, Price, RestaurantID) VALUES(" . $newMenuItem[ItemID] .", '" . $newMenuItem[Name] ."', '" . $newMenuItem[Type] ."', '" . $newMenuItem[Category] ."', '" . $newMenuItem[Description] . "', '" . $newMenuItem[Price] . "', " . $newMenuItem[RestaurantID] . ")";

		$result = pg_query($conn, $query);

		close_database_connection($conn);

		return $result;
	}

	function special_queries_e(){
		$conn = open_database_connection();

		$query = "SELECT R.Type, M.Category, ROUND(AVG(M.Price),2) 
					FROM MenuItem M, Restaurant R 
					GROUP BY R.Type, M.Category 
					ORDER BY R.Type, M.Category";

		$result = pg_query($conn, $query);

		$answer_e = array();

		while($row = pg_fetch_assoc($result)){
			$answer_e[] = $row;
		}

		close_database_connection($conn);

		return $answer_e;
	}

	function special_queries_f(){
		$conn = open_database_connection();

		$query = "SELECT R.UserID, S.Name, X.Name, COUNT(R.RestaurantID) 
					FROM Rater S, Rating R, Restaurant X 
					WHERE (R.RestaurantID = X.RestaurantID AND S.UserID = R.UserID) 
					GROUP BY R.UserID, S.Name, X.Name ORDER BY R.UserID";

					$result = pg_query($conn, $query);

		$answer_f = array();

		while($row = pg_fetch_assoc($result)){
			$answer_f[] = $row;
		}

		close_database_connection($conn);

		return $answer_f;
	}

	function special_queries_g(){

		$conn = open_database_connection();

		$query = "SELECT DISTINCT r.name, r.type,l.phone_number  FROM restaurant r
                	JOIN location l ON r.restaurantid = l.restaurantid
                	WHERE r.restaurantid NOT IN (SELECT ra.restaurantid FROM rating ra
                                             WHERE ra.date_submitted >= '2015-01-01'
                                             AND ra.date_submitted <= '2015-01-31')";

		$result = pg_query($conn, $query);

		$answer_g = array();

		while($row = pg_fetch_assoc($result)){
			$answer_g[] = $row;
		}

		close_database_connection($conn);

		return $answer_g;
	}

	function special_queries_j(){

		$conn = open_database_connection();

		$query = "SELECT R.Type, ROUND(AVG(RA.Overall),4) AS AVERAGE 
						FROM Restaurant R, Rating RA 
						WHERE RA.RestaurantID = R.RestaurantID 
						GROUP BY R.Type ORDER BY AVERAGE DESC";

		$result = pg_query($conn, $query);

		$answer_j = array();

		while($row = pg_fetch_assoc($result)){
			$answer_j[] = $row;
		}

		close_database_connection($conn);

		return $answer_j;
	}

		function special_queries_k(){

		$conn = open_database_connection();

		$query = "SELECT r.name, r.join_date, r.reputation, ra.date_submitted, re.name as resname FROM rater r, rating ra
               JOIN restaurant re ON re.restaurantid = ra.restaurantid
               WHERE r.userid=ra.userid AND ra.food='5' AND ra.mood='5'
               GROUP BY r.name, r.join_date, r.reputation, ra.date_submitted, resname";

		$result = pg_query($conn, $query);

		$answer_k = array();

		while($row = pg_fetch_assoc($result)){
			$answer_k[] = $row;
		}

		close_database_connection($conn);

		return $answer_k;
	}

	function special_queries_l(){
		$conn = open_database_connection();

		$query = "SELECT r.name, r.reputation, ra.date_submitted, re.name as resname FROM rater r, rating ra
               JOIN restaurant re ON re.restaurantid = ra.restaurantid
               WHERE r.userid=ra.userid AND ra.food='5' OR ra.mood='5'
               GROUP BY r.name, r.reputation, ra.date_submitted, resname";
               $result = pg_query($conn, $query);

		$answer_l = array();

		while($row = pg_fetch_assoc($result)){
			$answer_l[] = $row;
		}

		close_database_connection($conn);

		return $answer_l;
	}

?>