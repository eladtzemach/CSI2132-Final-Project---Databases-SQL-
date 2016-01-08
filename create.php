<?php
require_once 'model.php';

$userid       = get_new_userid();
$raterEnums   = get_all_rater_enums();

require 'templates/create.php';