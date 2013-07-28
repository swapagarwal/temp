<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

$username = $_POST["username"];
$password = $_POST["password"];
$credits = $_POST["credits"];
$query = "INSERT into kameng(username,password,credits)values('$username','$password','$credits') ";
$handle = (mysql_query($query));
if($handle) echo "Sign Up Successful";
else echo "Please try again";
?>
