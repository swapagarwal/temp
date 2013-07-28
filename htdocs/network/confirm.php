<?php
session_start();
mysql_connect('localhost','root','');
mysql_select_db('network');
$u=$_SESSION['user'];
$a=$_GET['a'];
$q=$u.'__friends';
$query="update $q set status=1 where name='$a'";
mysql_query($query);
$q=$a.'__friends';
$query="update $q set status=1 where name='$u'";
mysql_query($query);
echo "Query executed successfully.";
//echo $query;
header('location:users.php');
?>