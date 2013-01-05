<?php // Install



?>
<!doctype html>
<html>
<head>
	<title>Install 3CHAN</title>
	<link rel="stylesheet" href="css/yotsubanew.css">
	<style type="text/css">
	body {
		max-width: 960px;
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
		
		<legend>Administrator User</legend>
		<label>Username <input type="text" name="user" placeholder="admin"></label>
		<label>Password <input type="password" name="pass"></label>
		
		<legend>Boards</legend>
		<p>When first installed, your site will contain one board, /b/ - Random.  Additional boards can be configured after installation.</p>
		
		<button type="submit">Install</button>
	</form>
</body>
</html>