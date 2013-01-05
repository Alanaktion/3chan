<?php
require_once 'config.php';
require_once 'common.php';

// No authentication provided, exit
if(!$_COOKIE['ch_auth']) {
	include '403.php';
	exit();
}

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('UNABLE TO CONNECT TO DATABASE');

// Get provided authentication
list($user,$pass) = explode('|',$_COOKIE['ch_auth'],2);

// Load user information
$q = mysqli_query($db,"SELECT `pass`,`role` FROM `".DB_PREF."users` WHERE `user` = '".filter_alphanum($user)."' LIMIT 1");

// User does not exist in database
if(!mysqli_num_rows($q)) {
	mysqli_free_result($q);
	mysqli_close($db);
	setcookie('ch_auth','',time() - DAY);
	include '403.php';
	exit();
}

// Get user information
list($pass_sha1,$role) = mysqli_fetch_array($q);
mysqli_free_result($q);

// Invalid password
if($pass!=md5($pass_sha1)) {
	mysqli_close($db);
	setcookie('ch_auth','',time() - DAY);
	include '403.php';
	exit();
}



?>