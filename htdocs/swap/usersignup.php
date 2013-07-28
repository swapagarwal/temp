<?php

mysql_connect('localhost','root','');
mysql_select_db('swap');

$a=$_POST['username'];
$b=$_POST['firstname'];
$c=$_POST['lastname'];
$d=$_POST['email'];
$e=$_POST['password'];
$f=$_FILES["photo"]['name'];

move_uploaded_file($_FILES["photo"]['tmp_name'],'upload/'.$_FILES["photo"]['name']);

$query="insert into profile(username,firstname,lastname,email,password,photo)values('$a','$b','$c','$d','$e','$f')";
$r=mysql_query($query);

if ($r) echo "You have signed up successfully.";
else echo "Please try again.";
?>