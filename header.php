<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Moodledo - <?php echo $page; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!--<link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">-->
		<link href="css/bootstrap-paper.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</head>
<body>
<div id="wrap">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#moodledo-tasks-navbar-collapse">
        <span class="sr-only">Moodledo navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Moodledo</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="moodledo-tasks-navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php echo ($page == 'tasks') ? "class=\"active\"" : "" ?>><a href="#">Tasks</a></li>
        <li <?php echo ($page == 'lists') ? "class=\"active\"" : "" ?>><a href="lists.php">Lists</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		 <li class="dropdown">
			<?php 
			// User is loaded in index.php
			if(empty($user)) {
				echo "<a href=\"".$toodledo->getAuthURL()."\">Connect</span></a>";
			} else {
				echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">".$user['alias']."<span class=\"caret\"></span></a>";
				echo "<ul class=\"dropdown-menu\" role=\"menu\">";
				echo "<li><a href=\"?profile\">Profile</a></li>";
				echo "<li><a href=\"?preferences\">Preferences</a></li>";
				echo "<li class=\"divider\"></li>";
				echo "<li><a href=\"?logout\">Refresh</a></li>";
				echo "</ul>"; 
			}
			?>
        </li>
      </ul>
    </div>
  </div>
</nav>
