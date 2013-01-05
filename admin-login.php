<!doctype html>
<html>
<head>
	<title><?php echo CHAN_TITLE; ?> - Log In</title>
	<meta name="author" content="Alan Hardman, http://imalan.tk">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/yotsubanew.css">
	<style type="text/css">
	body {
		max-width: 750px;
		margin: 5px auto;
	}
	h1, p {
		text-align: center;
	}
	form {
		display: block;
		width: 270px;
		margin: 10px auto;
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
	<h1><?php echo CHAN_TITLE; ?></h1>
	<p>Administrators and Moderators, log in here.<br>
Other users, use <a href="faq/#tripcodes">tripcodes</a> to protect your identity.</p>
	<form action="admin.php" method="post">
		<label>Username: <input type="text" name="user"></label>
		<label>Password: <input type="password" name="pass"></label>
		<button type="submit">Log In</button>
	</form>
</body>
</html>