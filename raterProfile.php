<?php 
	require_once 'model.php';

	$userid = $_GET['userid'];

	$raterInfo 			= get_rater_info($userid);
	$raterReviewCount 	= get_rater_review_count($userid);
	$raterReviews 		= get_rater_reviews($userid);

	if (!$raterReviewCount){
		$raterReviewCount = 0;
	}

	require 'templates/raterProfile.php';

?>