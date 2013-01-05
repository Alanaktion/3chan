<!doctype html>
<html>
<head>
	<title><?php echo '/'.$board['slug'].'/ - '.htmlspecialchars($board['name']); ?></title>
	<meta name="author" content="Alan Hardman, http://imalan.tk">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="<?php echo $a_home; ?>css/yotsubanew.css">
</head>
<body>
<?php include 'parts/boardnav.php'; ?>
	<div class="boardBanner">
		<hgroup>
			<h1><?php echo CHAN_TITLE; ?></h1>
			<h2><?php echo '/'.$board['slug'].'/ - '.htmlspecialchars($board['name']); ?></h2>
		</hgroup>
	</div>
	<hr class="abovePostForm">
<?php include 'parts/postform.php'; ?>
</body>
</html>