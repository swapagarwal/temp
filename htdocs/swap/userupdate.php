<?php
session_start();
if ($_SESSION['id']==0) header('location:usersigninform.php');
mysql_connect('localhost','root','');
mysql_select_db('swap');

$id=$_SESSION['id'];
$p=$_GET['p'];
$a=$_POST['username'];
$b=$_POST['firstname'];
$c=$_POST['lastname'];
$d=$_POST['email'];
$e=$_POST['password'];
if ($p && $_FILES["photo"]['name']!="")
{ 
$f=$_FILES["photo"]['name'];
$i=move_uploaded_file($_FILES["photo"]['tmp_name'],'upload/'.$_FILES["photo"]['name']);
$query="update profile set username='$a',firstname='$b',lastname='$c',email='$d',password='$e',photo='$f' where id=$id";
}
else $query="update profile set username='$a',firstname='$b',lastname='$c',email='$d',password='$e' where id=$id"; 
$r=mysql_query($query);

if ($r) echo "You have updated your profile successfully.";
else echo "Please try again.";
echo "<a href='user.php'>View Profile</a>";
?>