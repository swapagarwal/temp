<?php
session_start();
mysql_connect('localhost','root','');
mysql_select_db('network');

$a=$_SESSION['user'];
if($a){} else {header('location:signin.php');}

echo "<form action='friend.php' method='post'><table><tr><td><h2>Users</h2></td><td></td><td></td></tr><br>";
$query="select * from users";
$handle=mysql_query($query);
$q=$a.'__friends';
while($row=mysql_fetch_array($handle))
{
	if($row[2]==$a) continue;
	$query="select * from $q where name='$row[2]'";
	//echo $query,"<br>";
	$h=mysql_query($query);
	//echo $h;
	if($h==FALSE)
	{
		echo "<tr><td>".$row[2]."</td><td>"."Add as a friend"."</td><td><a href='add.php?a=$row[2]'>Add</a></td></tr><br>";
		echo "false";
	}
	else
	{
		$r=mysql_fetch_array($h);
		if($r)
		{
			if($r[1]==1)
			{echo "<tr><td>".$row[2]."</td><td>"."Friend"."</td><td><input type='submit' name='friend' value='View $r[0] Profile'/>&nbsp;&nbsp;<a href='remove.php?a=$row[2]'>Remove</a></td></tr><br>";}
			if($r[1]==0)
			{echo "<tr><td>".$row[2]."</td><td>"."Confirm friend"."</td><td><a href='confirm.php?a=$row[2]'>Confirm</a></td></tr><br>";}
			if($r[1]==-1)
			{echo "<tr><td>".$row[2]."</td><td>"."Friend Request Sent"."</td><td><a href='remove.php?a=$row[2]'>Delete Request</a></td></tr><br>";}
		}
		else
		{
			echo "<tr><td>".$row[2]."</td><td>"."Add as a friend"."</td><td><a href='add.php?a=$row[2]'>Add</a></td></tr><br>";
		}
	}
}
?>