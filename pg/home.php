<!doctype html>
<html>
<head>
	<title><?php echo CHAN_TITLE; ?></title>
	<meta name="author" content="Alan Hardman, http://imalan.tk">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/yotsubanew.css">
	<style type="text/css">
	body {
		font: 13px/1.231 arial,helvetica,clean,sans-serif;
		max-width: 750px;
		margin: 5px auto;
		color: #800;
	}
	a,a:link,a:visited,a:active {
		color: #800;
	}
	h1 {
		text-align: center;
	}
	.box {
		background: #ffe;
		border: 1px solid #800;
		padding: 0 5px 5px;
		margin-bottom: 5px;
	}
	.box h2 {
		background: #FCA;
		color: #800;
		margin: 0 0 5px;
		margin: 0 -5px 5px;
		padding: 0 5px;
		line-height: 26px;
		font-size: 131%;
		font-weight: bold;
	}
	</style>
</head>
<body>
	<h1><?php echo CHAN_TITLE; ?></h1>
	<div class="box" id="boards">
		<h2>Boards</h2>
<?php
$list = board_list();
foreach($list as $b)
	echo '<a href="'.$a_home.$b['slug'].'/" title="'.$b['name'].'">'.$b['name'].'</a><br>';
?>
	</div>
</body>
</html>