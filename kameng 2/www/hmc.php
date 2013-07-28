<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

session_check();

$id = $_SESSION["id"];
$query = "SELECT * FROM kameng ";
$query.= "WHERE id='$id' ";
$row = mysql_fetch_array(mysql_query($query));
$name = $row["name"];
$credits = $row["credits"];
$lastprint = '';
$totalprint = '';

if (isset($_POST["credits-submit"])) {
	$search_user = $_SESSION["search_user"];
	$addcredits = $_POST["add_credits"];
	$query = "UPDATE tbl_users ";
	$query.= "SET Credits=Credits+'$addcredits' ";
	$query.= "WHERE Username='$search_user' ";
	$query.= "LIMIT 1";
	if (mysql_query($query)) {
		$_SESSION["search_user"] = "";
		msg_redir("Credits successfully updated!", "profile.php");
	} else {
		$_SESSION["search_user"] = "";
		msg_redir("Update of credits failed! Please contact the webmaster.", "profile.php");
	}
}

if (isset($_POST["password-submit"])) {
	$search_user = $_SESSION["search_user"];
	$newpassword = $_POST["new_password"];
	$newhash= hash("sha512", $newpassword);
	$query = "UPDATE tbl_users ";
	$query.= "SET Password='$newhash' ";
	$query.= "WHERE Username='$search_user' ";
	$query.= "LIMIT 1";
	if (mysql_query($query)) {
		$_SESSION["search_user"] = "";
		msg_redir("Password successfully changed!", "hmc.php");
	} else {
		$_SESSION["search_user"] = "";
		msg_redir("Password could not be changed! Please contact the webmaster.", "hmc.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $name; ?>: HMC Page</title>
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
			<li><a href="profile.php">Profile</a></li>
			<?php // History and settings to be implemented ?>
			<!--li><a href="#">History</a></li-->
			<?php if ($hmc) echo "<li class=\"sel\"><a href=\"#\">HMC</a></li>"; ?>
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
					<h3>Username: <?php echo "<strong>" . $username . "</strong>"; ?></h3>
					<div class="sep"></div>
					<ul class="numbers clearfix">
						<li>Credits<strong><?php echo $credits; ?></strong></li>
						<li>Last Print<strong><?php echo $lastprint; ?></strong></li>
						<li class="nobrdr">Total Print<strong><?php echo $totalprint; ?></strong></li>
					</ul>
				</div>
			</div>
			
			<h1>Edit User Data:</h1>
			<p>Search user: </p>
			<p>
				<form action="hmc.php" method="post">
				<p><input type="text" value="" name="user" /></p>
				<p><input type="submit" name="search-submit" class="submit" value="Search" /></p>
				</form>
			</p>
			
			<p>
			<?php
				if (isset($_POST["search-submit"])) {
					$search_user = $_POST["user"];
					$query = "SELECT * FROM tbl_users ";
					$query.= "WHERE Username='$search_user' ";
					$query.= "LIMIT 1";
					if ($row = mysql_fetch_array(mysql_query($query))) {
						$name = $row["Name"];
						$username = $row["Username"];
						$credits = $row["Credits"];
						$lastprint = $row["LastPrint"];
						$totalprint = $row["TotalPrint"];
						$hmc = $row["HMC"];
						$_SESSION["search_user"] = $search_user;
					} else msg_redir("Sorry! User does not exist!", "hmc.php");
					echo "Name: " . $name ."<br />";
					echo "Username: " . $username ."<br />";
					echo "Credits: " . $credits ."<br />";
					echo "Last Print: " . $lastprint ."<br />";
					echo "Total Print: " . $totalprint ."<br />";
			
					echo "<form action=\"hmc.php\" method=\"post\">
						<p>Add Credits:<br /><input type=\"text\" value=\"\" name=\"add_credits\" /></p>
						<p><input type=\"submit\" name=\"credits-submit\" class=\"submit\" value=\"Add Credits\" /></p>
					</form><br />";
			
					echo "<form action=\"hmc.php\" method=\"post\">
						<p>Change Password:<br /><input type=\"text\" value=\"\" name=\"new_password\" /></p>
						<p><input type=\"submit\" name=\"password-submit\" class=\"submit\" value=\"Change Password\" /></p>
						</form><br />";
				}
			?>
			</p>
			
		</section>
	</div>
</body>
</html>
