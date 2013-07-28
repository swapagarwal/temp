<?php
session_start();
mysql_connect('localhost','root','');
mysql_select_db('network');

$a=$_SESSION['user'];
if($a){} else {header('location:signin.php');}
$query="select * from users where username='$a'";
$row=mysql_fetch_array(mysql_query($query));
echo "<a href='signout.php'>Sign Out</a><br>";
echo "Name: ".$row[1]."<br>";
echo "Username: ".$row[2]."<br>";
echo "Email: ".$row[3]."<br>";
echo "Password: ".$row[4]."<br>";
echo "Birthday: ".$row[5]."<br>";
echo "Gender: ".$row[6]."<br>";

echo "<br><br><h2>Posts</h2><br>";

echo "What's on your mind..?";
echo "<br><form action='profile.php' method='post'><textarea name='status'></textarea><input type='submit' name='post' value='Post'/></form><br>";

$q=$a.'__posts';
$query="select * from $q";
$handle=mysql_query($query);
while($row=mysql_fetch_array($handle))
{
	if($row[1]==$a){echo "At ".$row[2].", ".$row[1]." wrote: ".$row[0]."<br><br>";}
	else{echo "At ".$row[2].", ".$row[1]." posted on ".$a."'s wall: ".$row[0]."<br><br>";}
}
$p=$a.'__friends';
$pp="select * from $p where status='1'";
$ppp=mysql_query($pp);
while($pppp=mysql_fetch_array($ppp))
{
	$q=$pppp[0].'__posts';
	$query="select * from $q";
	$handle=mysql_query($query);
	while($row=mysql_fetch_array($handle))
	{
		if($row[1]==$pppp[0]){echo "At ".$row[2].", ".$row[1]." wrote: ".$row[0]."<br><br>";}
		else{echo "At ".$row[2].", ".$row[1]." posted on ".$pppp[0]."'s wall: ".$row[0]."<br><br>";}
	}
}
echo "<a href='users.php'>Other Users</a>";
?>
<?php
if (isset($_POST["post"]))
{
	//echo date('d/m/y',time());
	//echo "<br>";
	//$t=time()%86400;
	//echo $t/3600;
	$q=$a.'__posts';
	$t=time();
	$p=$_POST['status'];
	$query="insert into $q(post,postedby,time)values('$p','$a','$t')";
	$handle=mysql_query($query);
	if ($handle) header('location:profile.php');
	else echo "Please try again..";
}
?>