<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

//session_check();
session_start();

$id = $_SESSION["id"];
$query = "SELECT * FROM kameng ";
$query.= "WHERE id='$id' ";
$row = mysql_fetch_array(mysql_query($query));
$name = $row["username"];
$credits = $row["credits"];
$lastprint='';
$totalprint='';

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $name; ?>: Kameng Profile</title>
<link rel="stylesheet" type="text/css" href="styles/welcome.css" />
</head>

<body>	
	<header>
		<div class="wrapper">
			<a href="http://intranet.iitg.ernet.in/hostels/kameng/"><img src="images/logo.png" alt="" title="" /></a>
			
			<?php // <span id="usernav"><a href="#">Logout</a> - <a href="#">Settings</a> - <a href="#">My Profile<span><img src="img/user_avatar_s.jpg" /></span></a></span> ?>
		</div>
	</header>
	
	<nav>
		<ul id="n" class="clearfix">
			<li><a href="http://intranet.iitg.ernet.in/hostels/kameng/">Home</a></li>
			<li class="sel"><a href="#">Profile</a></li>
			<?php // History to be implemented ?>
			<!--li><a href="#">History</a></li-->
			<!--<?php if ($hmc) echo "<li><a href=\"hmc.php\">HMC</a></li>"; ?>-->
			<li><a href="settings.php">Settings</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
	
	<div id="content" class="clearfix">
		<section id="left">
			<div id="userStats" class="clearfix">
				<div class="pic">
					<a href="#"><img src="images/Network-Web-Printer-icon.png" width="150" height="150" /></a>
				</div>
				
				<div class="data">
					<h1><?php echo $name; ?></h1>
					<h3>Username: <?php echo "<strong>" . $name . "</strong>"; ?></h3>
					<div class="sep"></div>
					<ul class="numbers clearfix">
						<li>Credits<strong><?php echo $credits; ?></strong></li>
						<!--<li>Last Print<strong><?php echo $lastprint; ?></strong></li>
						<li class="nobrdr">Total Print<strong><?php echo $totalprint; ?></strong></li>-->
					</ul>
				</div>
			</div>
			
			<h1>Network Printer:</h1>
			<p>Choose a file (.pdf) to upload: </p>
			<p>
				<form enctype="multipart/form-data" action="upload.php" method="post">
				<?php // <input type="hidden" name="MAX_FILE_SIZE" value="1000000000" /> ?>
				<p><input name="uploaded_file" type="file" /></p>
				<p><input type="submit" class="submit" value="Upload" /></p>
				</form>
			</p>
		</section>
	</div>
</body>
</html>
