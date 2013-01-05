<?php
require_once 'config.php';
require_once 'common.php';

// Connect to database
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Get requested page/board/thread
$pg = trim($_SERVER['REDIRECT_SCRIPT_URL'],'/');
$a_home = rtrim(rtrim($_SERVER['REDIRECT_SCRIPT_URI'],$_SERVER['REDIRECT_SCRIPT_URL']),'/').'/';
$pg = explode('/',$pg);

list($board,$subpage,$thread) = array($pg[0],$pg[1],$pg[2]);

// Home page
if(!$board) {
	include 'pg/home.php';
} else {
	$q = mysqli_query($db,"SELECT * FROM `".DB_PREF."boards` WHERE `slug` = '".filter_alphanum($board)."' LIMIT 1");
	if(mysqli_num_rows($q)) { // Board exists, display it
		$board = mysqli_fetch_array($q);
		mysqli_free_result($q);
		include 'pg/board.php';
	} else {
		mysqli_free_result($q);
		$page = mysqli_query($db,"SELECT * FROM `".DB_PREF."pages` WHERE `slug` = '".filter_alphanum($board)."' LIMIT 1");
		if(mysqli_num_rows($q)) { // Page exists, display it
			$a = mysqli_fetch_array($q);
			mysqli_free_result($q);
?>

<?php
		} else {
			mysqli_free_result($q);
			mysqli_close($db);
			include 'pg/404.php';
			exit();
		}
	}
}
?>