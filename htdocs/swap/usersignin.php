<?php
session_start();

mysql_connect('localhost','root','');
mysql_select_db('swap');

$a=$_POST['username'];
$b=$_POST['password'];

$query="select * from profile where username='$a' and password='$b'";
$r=mysql_query($query);

if ($i=mysql_fetch_array($r))
{
	echo "You have signed in successfully.";
	$id=$i[0];
	$_SESSION['id']=$id;
	echo "<a href='user.php'>View Profile</a>";
}
else
{
	echo "Please try again.";
	$_SESSION['id']=0;
}
?>