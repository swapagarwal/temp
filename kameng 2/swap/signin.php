<?php

require_once("includes/functions.php");

session_start();
$alert = 0;
/*
if (isset($_POST["submit"])) {

echo $_POST['username'],$_POST['password'];

	require_once("includes/connect.php");
	$username = mysql_real_escape_string($_POST["username"]);
	$password = ($_POST["password"]);
	//$hash = hash("sha512", $password);
	$hash=$password;
	$query = "SELECT Password FROM kameng ";
	$query.= "WHERE Username='$username' ";
	$query.= "LIMIT 1";
	
	if ($handle = mysql_query($query)) {
		$row = mysql_fetch_array($handle);
		if ($row["Password"] == $hash) {
			// User login successful
			$_SESSION["username"] = $username;
			header("Location: profile.php");
			exit;
			
		} else {
			// Invalid login
			$alert = 1;
		}
	}
}
*/
?>








<!DOCTYPE html>

<html>
<head>
<title>Kameng Login Page</title>
</head>

<body>
<?php

if ($alert) {
	echo "<script type='text/javascript'>alert('Incorrect login. Please try again.')</script>";
}

?>

<form id="login" action="signinpro.php" method="post">
    <h1>Log In</h1>
    <fieldset id="inputs">
        <input id="username" name="username" type="text" placeholder="Username" autofocus="" required="">   
        <input id="password" name="password" type="password" placeholder="Password">
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" name="submit" value="Sign in">
        <a href="#">Forgot your password?</a><?php //<a href="">Register</a> ?>
    </fieldset>
    <a href="http://intranet.iitg.ernet.in/hostels/kameng/" id="back">Back to Kameng Home Page...</a>
</form>
</body>
</html>
