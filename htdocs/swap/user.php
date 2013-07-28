<?php
session_start();
if ($_SESSION['id']==0) header('location:usersigninform.php');

$id=$_SESSION['id'];
mysql_connect('localhost','root','');
mysql_select_db('swap');
$query="select * from profile where id='$id'";
$r=mysql_query($query);
$i=mysql_fetch_array($r);
$a=$i[1];
$b=$i[2];
$c=$i[3];
$d=$i[4];
$e=$i[5];
$f=$i[6];
$g='upload/'.$f;
?>

<table align='center' border=2>

<tr>
<td>Username:</td>
<td><?php echo $a; ?></td>
</tr>

<tr>
<td>First Name:</td>
<td><?php echo $b; ?></td>
</tr>

<tr>
<td>Last Name:</td>
<td><?php echo $c; ?></td>
</tr>

<tr>
<td>Email:</td>
<td><?php echo $d; ?></td>
</tr>

<tr>
<td>Password:</td>
<td><?php echo $e; ?></td>
</tr>

<tr>
<td>Photo:</td>
<td><?php echo "<img height=200 width=200 src='$g'>"; ?></td>
</tr>

<tr>
<td><?php echo "<a href='usersignout.php'>Sign Out</a>"; ?></td>
<td><?php echo "<a href='useredit.php?p=0'>Edit Profile</a>"; ?></td>
</tr>

</table>