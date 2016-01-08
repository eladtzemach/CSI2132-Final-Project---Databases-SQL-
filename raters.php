<?php
require_once 'model.php';

$raters = get_all_raters();

$rater_avatar = array();

	foreach ($raters as $rater):
		$raterId = $rater['userid'];
		$rater_avatar[$raterId] = get_avatar_by_userid_not_psql($raterId);
	endforeach;

require 'templates/raters.php';