<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

session_start();
$username = $_POST["username"];
$password = hash("sha512", $_POST["password"]);
$query = "select * from kameng where username='$username' and password='$password'";
$row = mysql_fetch_array(mysql_query($query));
if($row)
{
	//echo "Sign In Successful";
	//else echo "Please try again";
	//echo $row[0],$row[1],$row[2],$row[3];
	$_SESSION['id']=$row[0];
	//echo $username,$password;
	header('location:profile.php');
}
else header('location:signin.php');
?>
