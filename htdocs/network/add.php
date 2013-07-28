<?php
session_start();
mysql_connect('localhost','root','');
mysql_select_db('network');
$u=$_SESSION['user'];
$a=$_GET['a'];
$q=$u.'__friends';
$query="insert into $q(name,status)values('$a','-1')";
mysql_query($query);
$q=$a.'__friends';
$query="insert into $q(name,status)values('$u','0')";
mysql_query($query);
echo "Query executed successfully.";
//echo $query;
header('location:users.php');
?>