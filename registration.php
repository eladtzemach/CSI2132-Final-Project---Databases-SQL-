<?php
    
    require_once 'model.php';

    $raterName      = trim($_POST['name']);
    $raterEmail     = trim($_POST['email']);
    $joinDate       = date('Y-m-d');
    $userid         = $_POST['userid'];
    $raterType      = $_POST['raterType'];

    // NOTE!!!
    // Assumption: Everything is entered correctly
    // Creating a new rater
    $rater = array();

    $rater[UserID]      = $userid;
    $rater[Email]       = $raterEmail;
    $rater[Name]        = $raterName;
    $rater[Join_Date]   = $joinDate;
    $rater[Type]        = $raterType;
    $rater[Reputation]  = 1;

    $addRater = insert_new_rater($rater);

    if (!$addRater) {
          echo "An error occurred.\n";
          exit;
    } else {

        session_start();
        
        $_SESSION['created']    = time();
        $_SESSION['name']       = $rater[Name];
        $_SESSION['email']      = $rater[Email];
        $_SESSION['userid']     = $rater[UserID];

        header("Location: raterProfile.php?userid=" . $_SESSION['userid']);
        die();
    }

?>