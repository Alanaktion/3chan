<?php
// Check for login
if(!$_COOKIE['ch_auth']) {
	if($_POST['user'] && $_POST['pass']) {
		$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('UNABLE TO CONNECT TO DATABASE');
		$q = mysqli_query($db,"SELECT `id` FROM `".DB_PREF."users` WHERE `user` = '".filter_alphanum($_POST['user'])."' AND `pass` = '".sha1($_POST['pass'])."' LIMIT 1");
		if(mysqli_num_rows($q)) {
			mysqli_close($db);
			setcookie('ch_auth',$_POST['user'].'|'.md5(sha1($_POST['pass'])),time() + WEEK * 2);
			header('Location: admin.php');
			exit();
		}
		mysqli_close($db);
	}
	include 'admin-login.php';
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
	header("Location: admin.php");
	exit();
}

// Get user information
list($pass_sha1,$role) = mysqli_fetch_array($q);
mysqli_free_result($q);

// Invalid password
if($pass!=md5($pass_sha1)) {
	mysqli_close($db);
	setcookie('ch_auth','',time() - DAY);
	header("Location: admin.php");
	exit();
}
?>