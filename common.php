<?php
// common.php
// A set of common functions and definitions used by several parts of the site

// Times in seconds
define('MINUTE',60);
define('HOUR',  3600);
define('DAY',   86400);
define('WEEK',  604800);
define('MONTH', 2592000);
define('YEAR',  31536000);

// Generate a 10-character tripcode from a string
function tripcode($str) {
	$hash = sha1(trim($str));
	return substr($hash,strlen($hash) - 10);
}

// Remove non-alphanumeric characters from a string
function filter_alphanum($str) {
	return preg_replace('/([^A-Za-z0-9])/','',$str);
}

// Remove non-alphabetic characters from a string
function filter_alpha($str) {
	return preg_replace('/([^A-Za-z])/','',$str);
}

// Remove non-numeric characters from a string
function filter_num($str) {
	return preg_replace('/([^0-9])/','',$str);
}

// Get the list of boards
function board_list() {
	global $db;
	$q = mysqli_query($db,"SELECT `id`,`slug`,`name`,`sfw`,`text` FROM `".DB_PREF."boards`");
	$a = array();
	while($r = mysqli_fetch_assoc($q))
		$a[$r['id']] = $r;
	mysqli_free_result($q);
	return $a;
}

?>