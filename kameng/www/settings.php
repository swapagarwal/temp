<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

session_check();

$username = $_SESSION["username"];
$query = "SELECT * FROM tbl_users ";
$query.= "WHERE Username='$username' ";
$query.= "LIMIT 1";
$row = mysql_fetch_array(mysql_query($query));
$name = $row["Name"];
$hash = $row["Password"];
$credits = $row["Credits"];
$lastprint = $row["LastPrint"];
$totalprint = $row["TotalPrint"];
$hmc = $row["HMC"];

if (isset($_POST["name-submit"])) {
	$new_name = mysql_real_escape_string($_POST["name"]);
	$query = "UPDATE tbl_users ";
	$query.= "SET Name='$new_name' ";
	$query.= "WHERE Username='$username' ";
	$query.= "LIMIT 1";
	if (mysql_query($query)) {
		msg_redir("Name successfully updated!", "profile.php");
	} else {
		msg_redir("Name could not be updated! Please contact the webmaster.", "profile.php");
	}
}

if (isset($_POST["password-submit"])) {
	if (hash("sha512", $_POST["password-old"]) != $hash) {
		msg_redir("The current password entered was incorrect!", "settings.php");
	}
	if ($_POST["password-new1"] != $_POST["password-new2"]) {
		msg_redir("The new password entered does not match with the confirm new password!", "settings.php");
	}
	$newpassword = $_POST["password-new1"];
	$newhash= hash("sha512", $newpassword);
	$query = "UPDATE tbl_users ";
	$query.= "SET Password='$newhash' ";
	$query.= "WHERE Username='$username' ";
	$query.= "LIMIT 1";
	if (mysql_query($query)) {
		msg_redir("Password successfully changed!", "profile.php");
	} else {
		msg_redir("Password could not be changed! Please contact the webmaster.", "profiles.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title><?php echo $name; ?>: Settings Page</title>
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
			<?php // History to be implemented ?>
			<!--li><a href="#">History</a></li-->
			<?php if ($hmc) echo "<li><a href=\"hmc.php\">HMC</a></li>"; ?>
			<li class="sel"><a href="#">Settings</a></li>
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
					<h3>Username: <?php echo "<strong>" . $username . "</strong>"; ?></h>
					<div class="sep"></div>
					<ul class="numbers clearfix">
						<li>Credits<strong><?php echo $credits; ?></strong></li>
						<li>Last Print<strong><?php echo $lastprint; ?></strong></li>
						<li class="nobrdr">Total Print<strong><?php echo $totalprint; ?></strong></li>
					</ul>
				</div>
			</div>
			
			<h1>Settings:</h1>
			<p><strong>Change name:</strong>
				<form action="settings.php" method="post">
				<p><input type="text" name="name" value=<?php echo "\"". $name ."\""; ?> /></p>
				<p><input type="submit" class="submit" name="name-submit" value="Change Name" /></p>
				</form><br />
			</p>
			<p><strong>Change password:</strong>
				<form action="settings.php" method="post">
				<p>Current password: <br /><input type="password" name="password-old" value="" /></p>
				<p>New password: <br /><input type="password" name="password-new1" value="" /></p>
				<p>Confirm new password: <br /><input type="password" name="password-new2" value="" /></p>
				<p><input type="submit" class="submit" name="password-submit" value="Change Password" /></p>
				</form>
			</p>
		</section>
	</div>
</body>
</html>