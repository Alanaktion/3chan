<?php
require_once 'common.php';

if(isset($_POST['db_host']))
$db = mysqli_connect(
	$_POST['db_host'] ? $_POST['db_host'] : 'localhost',
	$_POST['db_user'] ? $_POST['db_user'] : 'root',
	$_POST['db_pass'],
	$_POST['db_name']
);

if($db) {
	// Save config.php
	file_put_contents('config.php',"<?php

// Database Connection
define('DB_HOST','".addslashes($_POST['db_host'] ? $_POST['db_host'] : 'localhost')."');
define('DB_USER','".addslashes($_POST['db_user'] ? $_POST['db_user'] : 'root')."');
define('DB_PASS','".addslashes($_POST['db_pass'])."');
define('DB_NAME','".addslashes($_POST['db_name'])."');
define('DB_PREF','".addslashes($_POST['db_pref'])."');

// Site Title
define('CHAN_TITLE','".addslashes($_POST['title'] ? $_POST['title'] : '3CHAN')."');

?>");
	
	// Define DB_PREF for convenience
	define('DB_PREF',$_POST['db_pref']);
	
	// Add database structure
	mysqli_query($db,"CREATE TABLE IF NOT EXISTS `".DB_PREF."boards` (
		`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`slug` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
		`name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
		`filetypes` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
		`max_filesize` int(10) unsigned NOT NULL DEFAULT '2048',
		`max_threads` int(10) unsigned NOT NULL DEFAULT '100',
		`max_replyimages` int(10) unsigned NOT NULL DEFAULT '200',
		`sfw` tinyint(1) NOT NULL DEFAULT '1',
		`text` tinyint(1) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		UNIQUE KEY `slug` (`slug`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
	mysqli_query($db,"CREATE TABLE IF NOT EXISTS `".DB_PREF."pages` (
		`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`slug` varchar(32) NOT NULL,
		`name` varchar(128) NOT NULL,
		`text` mediumtext NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `slug` (`slug`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
	mysqli_query($db,"CREATE TABLE IF NOT EXISTS `".DB_PREF."posts` (
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`board` int(10) unsigned NOT NULL,
		`thread` bigint(20) unsigned NOT NULL,
		`name` tinytext NOT NULL,
		`email` tinytext NOT NULL,
		`subject` tinytext NOT NULL,
		`text` text NOT NULL,
		`image` varchar(128) NOT NULL,
		`password` varchar(96) NOT NULL,
		`datetime` datetime NOT NULL,
		`ip` varchar(15) NOT NULL,
		PRIMARY KEY (`id`),
		KEY `thread` (`thread`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
	mysqli_query($db,"CREATE TABLE IF NOT EXISTS `".DB_PREF."users` (
		`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		`user` varchar(128) NOT NULL,
		`pass` varchar(40) NOT NULL,
		`role` enum('admin','mod') NOT NULL DEFAULT 'mod',
		PRIMARY KEY (`id`),
		UNIQUE KEY `user` (`user`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
	
	// Create administrator user
	$user = $_POST['user'] ? $_POST['user'] : 'admin';
	$pass = $_POST['pass'] ? $_POST['pass'] : 'password';
	mysqli_query($db,"INSERT INTO `".DB_PREF."users` VALUES('','".filter_alphanum($user)."','".sha1($pass)."','admin')");
	
	// Create /b/ - Random (primary board)
	mysqli_query($db,"INSERT INTO `".DB_PREF."boards` VALUES('1','b','Random','jpg,png,gif','2048','100','200','0','0')");
	
	// Log in to administrator panel
	setcookie('ch_auth',$user.'|'.md5(sha1($pass)),time() + WEEK * 2);
	header('Location: admin.php');
	
	// Delete installer
	//unlink('install.php'); // Not sure yet :/
	exit();
	
} else {
	// Database connection failed
	
	
}

?>
<!doctype html>
<html>
<head>
	<title>Install 3CHAN</title>
	<meta name="author" content="Alan Hardman, http://imalan.tk">
	<link rel="stylesheet" href="css/yotsubanew.css">
	<style type="text/css">
	body {
		max-width: 750px;
		margin: 5px auto;
	}
	p {
		margin-top: 0;
	}
	legend {
		font-size: 150%;
		line-height: 2;
		margin-top: 5px;
	}
	label {
		clear: right;
		display: block;
		line-height: 2;
		width: 270px;
	}
	label input {
		float: right;
		vertical-align: middle;
	}
	input[type="password"] {
		width: auto;
		text-align: left;
	}
	</style>
</head>
<body>
	<h1>Install</h1>
	<p><strong>IMPORTANT:</strong> Using the installer will overwrite your config.php file!</p>
	<form action="install.php" method="post">
		<legend>Database Connection</legend>
		<label>Host <input type="text" name="db_host" placeholder="localhost"></label>
		<label>Username <input type="text" name="db_user" placeholder="root"></label>
		<label>Password <input type="password" name="db_pass"></label>
		<label>Database Name <input type="text" name="db_name"></label>
		<label>Table Prefix <input type="text" name="db_pref" value="ch_"></label>
		<p>Table prefix should be empty or end with an underscore!</p>
		
		<legend>Administrator User</legend>
		<label>Username <input type="text" name="user" placeholder="admin"></label>
		<label>Password <input type="password" name="pass" placeholder="pass"></label>
		<p><strong>Note:</strong> Administrator password will not be stored in plain text.</p>
		
		<legend>Site</legend>
		<label>Site Title <input type="text" name="title" placeholder="3CHAN"></label>
		
		<button type="submit">Install</button>
	</form>
</body>
</html>