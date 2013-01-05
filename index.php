<?php
require_once 'config.php';

// Get requested page/board/thread
$pg = ltrim($_SERVER['REQUEST_URI'],rtrim($_SERVER['SCRIPT_NAME'],'index.php'));
$pg = substr($pg,0,strpos($pg,'?'));
$pg = explode('/',$pg);

list($board,$subpage,$thread) = array($pg[0],$pg[1],$pg[2]);

// Home page
if(!$board) {
?>
<!doctype html>
<html>
<head>
	<title><?php echo CHAN_TITLE; ?></title>
	<meta name="author" content="Alan Hardman, http://imalan.tk">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/yotsubanew.css">
</head>
<body>
	<h1><?php echo CHAN_TITLE; ?></h1>
</body>
</html>
<?php
} else {


}
?>