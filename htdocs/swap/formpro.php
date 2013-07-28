<?php

mysql_connect('localhost','root','');
mysql_select_db('swap');

$username=$_POST['username'];
$password=$_POST['password'];
$gender=$_POST['gender'];

$query="insert into form (username,password,gender)values('$username','$password','$gender')";
$handle=mysql_query($query);
if ($handle) echo "Success";
else echo "Not Success";

echo "<br>";
echo "<a href='form.php'>Back....</a>";
//echo $username,$password,$gender;
?>