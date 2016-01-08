<?php
	require_once 'model.php';

	$expiry = 60 * 60 * 24 * 3;

	if (empty($_POST['submitted'])){
		session_start();
		session_destroy();
		require 'templates/signin.php';

	} elseif(isset($_POST['submitted']) && isset($_POST['name']) && isset($_POST['email'])) {

		// Reference: http://stackoverflow.com/questions/22376232/is-session-in-php-reset-on-every-page-load

		session_start();

		$getUserId = check_rater_existence($_POST['name'], $_POST['email']);

		if ($getUserId){
			$_SESSION['created'] 	= time();
			$_SESSION['name'] 		= trim($_POST['name']);
			$_SESSION['email'] 		= trim($_POST['email']);
			$_SESSION['userid'] 	= $getUserId['userid'];

			header('Location: raterProfile.php?userid=' . $_SESSION['userid']);
			die();

		} else {
			echo "OH OH";
			session_destroy();
		}
	} else {
		header('Location: signin.php');
		die();
	}

?>